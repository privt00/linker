<?php include(BASE_PATH.'resources/components/head.php'); ?>
<?php include(BASE_PATH.'resources/components/dashboard_auth_check.php'); ?>
<?php include(BASE_PATH.'resources/components/sidebar.php'); ?>

    <div class="w-[84%] h-screen fixed top-0 right-0 bg-neutral-900 p-14">

        <!-- Single large card -->
        <div class="bg-neutral-800 border border-white/10 rounded-lg shadow-md overflow-hidden">

            <div class="px-4 py-3 border-b border-white/10">
                <h2 class="text-white text-sm font-semibold">G-code Files</h2>
            </div>

            <div id="gcode-list" class="divide-y divide-white/5">
                <div class="p-4 text-neutral-400 text-sm">Loading...</div>
            </div>

        </div>

    </div>

    <script>
        async function loadGcodes() {
            const res = await fetch("/api/gcodes", {
                method: "GET",
                headers: { "Accept": "application/json" }
            });

            const data = await res.json();

            const container = document.getElementById("gcode-list");
            container.innerHTML = "";

            if (!data.length) {
                container.innerHTML = `<div class="p-4 text-neutral-400 text-sm">No files found</div>`;
                return;
            }

            data.forEach(file => {
                const row = document.createElement("div");

                row.className =
                    "p-4 flex items-center justify-between hover:bg-white/5 transition";

                row.innerHTML = `
            <div class="flex flex-col">
                <span class="text-white text-sm font-medium">${file.name}</span>
                <span class="text-xs text-neutral-400">
                    ${file.lines.toLocaleString()} lines ·
                    ${file.estimatedMinutes} min ·
                    ${(file.sizeKb / 1024).toFixed(1)} MB
                </span>
            </div>

            <div class="flex gap-2">
                <button class="px-3 py-1 text-xs bg-blue-400 hover:bg-neutral-600 rounded">
                    Preview
                </button>

                <button class="px-3 py-1 text-xs bg-orange-600 hover:bg-orange-500 rounded"
                        onclick="selectGcode('${file.id}')">
                    Print
                </button>
            </div>
        `;

                container.appendChild(row);
            });
        }

        function selectGcode(id) {
            fetch("/api/gcodes/print?id=" + encodeURIComponent(id), {
                method: "GET",
                headers: { "Accept": "application/json" }
            });
        }

        loadGcodes();
    </script>

<?php include(BASE_PATH.'resources/components/footer.php'); ?>