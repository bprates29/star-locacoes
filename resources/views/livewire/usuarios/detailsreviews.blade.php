<div>
    <div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    @if (session()->has('message'))
                        <div
                            class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                            role="alert">
                            <div class="flex">
                                <div>
                                    <p class="text-sm">{{ session('message') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="flex flex-col space-y-4 ...">
                        <div>
                            Olá {{auth()->user()->name}}, revisões do seu carro estão nessa página
                        </div>

                        <div wire:loading>
                            Recuperando os repasses para esse contrato...
                            <div role="status">
                                <svg
                                    class="inline mr-2 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-500"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor"/>
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>

                        @if($isModalOpen)
                            @include('livewire.usuarios.photos')
                        @endif
                        <div class="overflow-x-auto relative">
                            <div class="pb-5 pt-2">
                                <h3 class="text-3xl font-bold dark:text-white">Carro
                                    <span
                                        class="bg-blue-100 text-blue-800 text-2xl font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-2">
                                    {{ $carro->marca }}</span>
                                    Placa <span
                                        class="bg-blue-100 text-blue-800 text-2xl font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-2">
                                    {{ $carro->placa }}</span></h3>
                            </div>

                            <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
                                <div class="flex flex-col pb-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Data da Revisão</dt>
                                    <dd class="text-lg font-semibold">{{ date("d/m/Y", strtotime($review->data)) }}</dd>
                                </div>
                                <div class="flex flex-col py-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Km do carro no momento
                                        da revisão
                                    </dt>
                                    <dd class="text-lg font-semibold">{{ $review->km }}</dd>
                                </div>
                                <div class="flex flex-col pt-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status do óleo do
                                        motor
                                    </dt>
                                    <dd class="text-lg font-semibold">{{ $review->oleo }}</dd>
                                </div>
                                <div class="flex flex-col pt-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Observações da
                                        revisão
                                    </dt>
                                    <dd class="text-lg font-semibold" style="white-space:pre-line">{{ $review->obs }}</dd>
                                </div>

                                <div class="flex flex-col pt-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Algumas fotos da
                                        revisão
                                    </dt>
                                </div>
                            </div>

                            <section class="overflow-hidden text-gray-700 ">
                                <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
                                    <div class="flex flex-wrap -m-1 md:-m-2">
                                        @foreach($photos as $photo)
                                            <div class="flex flex-wrap w-1/3">
                                                <div class="w-full p-1 md:p-2">
                                                    <img alt="gallery"
                                                         class="block object-cover object-center w-full h-full rounded-lg"
                                                         src="{{ asset('storage/'. $photo->pasta . '/' . $photo->nome) }}"
                                                         wire:click="abrePhotoModal('{{ asset('storage/'. $photo->pasta . '/' . $photo->nome) }}')">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>

                            <section class="overflow-hidden text-gray-700 float-right">
                                <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
                                    <a href="{{ route('user.revisoes', $carro->id) }}" type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Voltar para as revisões deste carro
                                        <svg aria-hidden="true" class="ml-2 -mr-1 w-5 h-5" fill="currentColor"
                                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
