<?php include(BASE_PATH . 'resources/components/head.php'); ?>

    <div class="w-screen h-screen flex justify-center items-center">
        <div class="w-100 h-40 bg-neutral-900 p-5 border-1 border-neutral-200/20 rounded-[4px] text-neutral-100 flex items-center">
            <form action="/api/login" method="POST">
                <h2 class="font-bold">Login</h2>
                <label for="">Address:</label>
                <br>
                <input type="text" id="address" name="address" placeholder="http://xxx.xxx.xxx.xxx"
                       class="bg-neutral-300 rounded-[4px] text-neutral-800 p-1">
                <br>
                <input type="submit" value="Login" class="bg-neutral-200 px-5 py-1 text-neutral-800 rounded-[5px] mt-2">
            </form>
        </div>
    </div>


<?php include(BASE_PATH . 'resources/components/footer.php'); ?>