<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../output.css" rel="stylesheet" type="text/css">
    <title>AcadexaVault</title>
</head>
<body class="bg-gray-100">
    <?php include('commons/header.html') ?>

    <main class="pt-16 pb-16 min-h-screen"> 
        <div class="flex flex-col items-center gap-24 pt-8 px-4">
            <div id="search-bar" class="relative w-full max-w-2xl"> 
                <input type="text" placeholder="Search.." class="w-full px-4 py-3 pr-12 rounded-xl border-2 border-gray-400 focus:outline-none
                                                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>


            <div id="home-btns" class="w-full max-w-6xl">
                <div class="flex flex-wrap justify-center gap-6">
                    <div class="flex-1 min-w-[250px] max-w-[300px] text-center bg-white rounded-xl p-6 border-1 border-[var(--color-green-gray-blue)] hover:shadow-lg transition-shadow">
                        <svg class="w-10 h-10 mx-auto mb-4 text-[var(--color-green-gray-blue)]" xmlns="http://www.w3.org/2000/svg" 
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                        <h3 class="text-xl font-semibold mb-2">Upload</h3>
                        <p class="text-gray-600">Lorem ipsum dolor sit amet. Ut reprehenderit dolorem est 
                            reiciendis quia id reiciendis illo hic temporibus distinctio et modi iusto.</p>
                    </div>
                    
                    <div class="flex-1 min-w-[250px] max-w-[300px] text-center bg-white rounded-xl p-6 border-1 border-[var(--color-green-gray-blue)] hover:shadow-lg transition-shadow">
                        <svg class="w-10 h-10 mx-auto mb-4 text-[var(--color-green-gray-blue)]" xmlns="http://www.w3.org/2000/svg" 
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <h3 class="text-xl font-semibold mb-2">Steps</h3>
                        <p class="text-gray-600">Lorem ipsum dolor sit amet. Ut reprehenderit dolorem est 
                            reiciendis quia id reiciendis illo hic temporibus distinctio et modi iusto.</p>
                    </div>
                    
                    <div class="flex-1 min-w-[250px] max-w-[300px] text-center bg-white rounded-xl p-6 border-1 border-[var(--color-green-gray-blue)] hover:shadow-lg transition-shadow">
                        <svg class="w-10 h-10 mx-auto mb-4 text-[var(--color-green-gray-blue)]" xmlns="http://www.w3.org/2000/svg" 
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 1 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712l.003-2.024a.668.668 0 0 1 .198-.471 1.575 1.575 0 1 0-2.228-2.228 3.818 3.818 0 0 0-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0 1 16.35 15m.002 0h-.002" />
                        </svg>
                        <h3 class="text-xl font-semibold mb-2">Policy</h3>
                        <p class="text-gray-600">Lorem ipsum dolor sit amet. Ut reprehenderit dolorem est 
                            reiciendis quia id reiciendis illo hic temporibus distinctio et modi iusto.</p>
                    </div>
                    
                    <div class="flex-1 min-w-[250px] max-w-[300px] text-center bg-white rounded-xl p-6 border-1 border-[var(--color-green-gray-blue)] hover:shadow-lg transition-shadow">
                        <svg class="w-10 h-10 mx-auto mb-4 text-[var(--color-green-gray-blue)]" xmlns="http://www.w3.org/2000/svg" 
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                        <h3 class="text-xl font-semibold mb-2">FAQs</h3>
                        <p class="text-gray-600">Lorem ipsum dolor sit amet. Ut reprehenderit dolorem est 
                            reiciendis quia id reiciendis illo hic temporibus distinctio et modi iusto.</p>
                    </div>
                </div>
            </div>

            <div id="desc" class="w-full">
                <div class="flex flex-col items-center justify-center">
                    <h1 class="text-4xl font-bold mb-2 text-center">AcadexaVault</h1>
                    <h3 class="text-xl max-w-xl text-gray-600 text-center leading-relaxed">serves as the institutional repository of PHINMA-University of Pangasinan,
                                                                    preserving the scholarly work produced by members of the university, and providing a platform
                                                                    to showcase their academic achievements to the world.</h3>
                </div>
            </div>
        </div>
    </main>

    <?php include('commons/footer.html') ?>
</body>
</html>