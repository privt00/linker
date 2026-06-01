<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

function isActive($path, $currentPath) {

    if ($currentPath == $path) {
        return 'bg-neutral-200/15 rounded-[5px] text-fg-brand border-l-4 border-fg-brand pl-2';
    } else {
        return '';
    }
}
?>


<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-full transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-neutral-900 border-e border-default text-neutral-200">
    <ul>
      <h2 class="font-bold text-[24px]">Linker Dashboard</h2>
      <hr class="mt-[10px] mb-[10px]">
    </ul>


      <ul class="space-y-2 font-medium">
         <li>
             <a href="/dashboard" class="nav-link flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group <?php echo isActive('/dashboard', $currentPath) ?>">
               <svg class="w-5 h-5 transition duration-75 group-hover:text-fg-brand" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z"/><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z"/></svg>
               <span class="ms-3">Dashboard</span>
            </a>
         </li>
      </ul>

       <ul class="space-y-2 font-medium">
           <li>
               <a href="/gcodes" class="nav-link flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group <?php echo isActive('/gcodes', $currentPath) ?>">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transition duration-75 group-hover:text-fg-brand">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                   </svg>

                   <span class="ms-3">G-CODES</span>
               </a>
           </li>
       </ul>
   </div>
</aside>