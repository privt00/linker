<?php include(BASE_PATH.'resources/components/head.php'); ?>
<?php include(BASE_PATH.'resources/components/dashboard_auth_check.php'); ?>
<?php include(BASE_PATH.'resources/components/sidebar.php'); ?>

    <div class="w-[84%] h-screen fixed top-0 right-0 bg-neutral-900 p-14 grid grid-cols-2 gap-4">

        <!-- State -->
        <div class="bg-neutral-800 border border-white/10 rounded-lg shadow-md overflow-hidden">
            <div class="px-3 py-2 border-b border-white/10">
                <h2 class="text-white text-base font-semibold">State</h2>
            </div>

            <div class="p-3">
                <table class="w-full text-xs text-neutral-300">
                    <thead class="text-neutral-400 border-b border-white/10">
                    <tr>
                        <th>Speed</th>
                        <th>Flow</th>
                        <th>Filament</th>
                        <th>Layer</th>
                    </tr>
                    </thead>

                    <tbody class="text-center">
                    <tr class="hover:bg-white/5">
                        <td class="py-2">0 mm/s</td>
                        <td>0.0 mm³/s</td>
                        <td>0.0 mm</td>
                        <td>0 / 125</td>
                    </tr>

                    <tr class="border-t border-white/10 text-neutral-400">
                        <td colspan="4" class="py-2 text-left">
                            <div id="print_state" class="text-xs">
                                Loading print status...
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Temps -->
        <div class="bg-neutral-800 border border-white/10 rounded-lg shadow-md overflow-hidden">
            <div class="px-3 py-2 border-b border-white/10">
                <h2 class="text-white text-base font-semibold">Temperatures</h2>
            </div>

            <div class="p-3">
                <table class="w-full text-xs text-neutral-300">
                    <thead class="text-neutral-400 border-b border-white/10">
                    <tr>
                        <th></th>
                        <th class="text-left">Name</th>
                        <th>Current</th>
                        <th>Target</th>
                    </tr>
                    </thead>

                    <tbody class="text-center">

                    <tr class="border-b border-white/5 hover:bg-white/5">
                        <td class="py-2">🔥</td>
                        <td class="text-left">Hotend</td>
                        <td id="temp_hotend" class="font-medium">0°</td>
                        <td>
                            <input id="temp_hotend_target"
                                   class="w-14 px-1 py-1 bg-neutral-700 rounded text-center text-white text-xs focus:ring-1 focus:ring-orange-500"
                            />
                        </td>
                    </tr>

                    <tr class="hover:bg-white/5">
                        <td class="py-2">🛏️</td>
                        <td class="text-left">Bed</td>
                        <td id="temp_bed" class="font-medium">0°</td>
                        <td>
                            <input id="temp_bed_target"
                                   class="w-14 px-1 py-1 bg-neutral-700 rounded text-center text-white text-xs focus:ring-1 focus:ring-orange-500"
                            />
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Camera -->
        <div class="bg-neutral-800 border border-white/10 rounded-lg shadow-md overflow-hidden h-94">
            <div class="px-3 py-2 border-b border-white/10">
                <h2 class="text-white text-base font-semibold">Camera</h2>
            </div>

            <div class="p-3 flex justify-center">
                <img src="/assets/img/mock-printer.png">
            </div>

        </div>

    </div>

    <script>

        const temp_hotend_el = document.getElementById("temp_hotend");
        const temp_bed_el = document.getElementById("temp_bed");

        const temp_hotend_target_el = document.getElementById("temp_hotend_target");
        const temp_bed_target_el = document.getElementById("temp_bed_target");

        refresh_temps();

        setInterval(() => {
            refresh_temps();
        }, 8000);

        async function refresh_temps() {

            const temps = await fetch("/api/temp", {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                }
            }).then(response => response.json());

            const temp_hotend = temps.hotend.current;
            const temp_bed = temps.bed.current;

            const temp_hotend_target = temps.hotend.target;
            const temp_bed_target = temps.bed.target;

            temp_hotend_el.innerText = temp_hotend + "°";
            temp_bed_el.innerText = temp_bed + "°";

            temp_hotend_target_el.value = temp_hotend_target + "°";
            temp_bed_target_el.value = temp_bed_target + "°";

        }

        temp_hotend_target_el.addEventListener("change", (setTargetHotend));

        async function setTargetHotend() {
            const target = temp_hotend_target_el.value.replace("°", "");

            const response = await fetch("/api/temp/hotend?target=" + target, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                },
            }).then(response => response.json());

            refresh_temps();
        }

        temp_bed_target_el.addEventListener("change", (setTargetBed));

        async function setTargetBed() {
            const target = temp_bed_target_el.value.replace("°", "");

            const response = await fetch("/api/temp/bed?target=" + target, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                },
            }).then(response => response.json());

            refresh_temps();
        }

        async function refresh_print_state() {

            const res = await fetch("/api/print", {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                }
            });

            const data = await res.json();
            const job = data.printJob;

            const el = document.getElementById("print_state");

            if (!job || job.active === false) {
                el.innerHTML = "No active print job";
                return;
            }

            const progress = job.progress ?? 0;

            const remainingSec =
                (job.estimatedSeconds ?? 0) * (1 - progress / 100);

            const percent = Math.max(0, Math.min(100, progress));

            el.innerHTML = `
                <div class="space-y-2">

${job.previewURL ? `
    <div class="w-full h-32 overflow-hidden rounded border border-white/10 mb-2">
        <img src="${job.previewURL}"
             class="h-full"
             style="width: 200%; object-fit: cover; object-position: left center;">
    </div>
` : ''}
                    <div class="flex justify-between">
                        <span class="text-white">${job.file}</span>
                        <span class="text-neutral-400 text-xs">${Math.round(percent)}%</span>
                    </div>

                    <div class="w-full bg-neutral-700 rounded-full h-2 overflow-hidden">
                        <div class="bg-orange-500 h-2 transition-all duration-300"
                             style="width: ${percent}%"></div>
                    </div>

                    <div class="text-xs text-neutral-400 flex justify-between">
                        <span>Printing...</span>
                        <span>${Math.max(0, Math.round(remainingSec / 60))} min left</span>
                    </div>

                </div>
            `;
        }

        refresh_print_state();
        setInterval(refresh_print_state, 2000);

    </script>

<?php include(BASE_PATH.'resources/components/footer.php'); ?>