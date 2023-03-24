<div
        x-data="{ open: true }"
        x-show.transition.duration.500ms="open"
        x-init="() => { setTimeout(() => { open = true }, 3000); }"
        class="fixed inset-0 bg-white bg-opacity-75 flex items-center justify-center px-4 md:px-0"
    >
        <div class="flex flex-col max-w-lg bg-white shadow-2xl rounded-lg border-2 border-gray-400 p-6" @click.away="open = false">
            <div class="flex justify-between mb-4">
                <h3 class="font-bold text-2xl">Welcome! 🚀</h3>
                <button @click="open = false">
                    <svg version="1.1" id="Capa_1" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717
                                    L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859
                                    c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287
                                    l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285
                                    L284.286,256.002z"/>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            <div class="">
                <p class="text-center mb-6">Your content goes here! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eu rutrum lorem.</p>
                <img class="w-full h-64" src="https://images.pexels.com/photos/954599/pexels-photo-954599.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260">
            </div>
        </div>
    </div>
