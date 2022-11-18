<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                         role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                    </div>
                @endif
                    <div class="flex flex-col space-y-4 ...">
                        <div>

                        </div>
                        <div wire:loading>
                            Recuperando os repasses para esse contrato...
                            <div role="status">
                                <svg class="inline mr-2 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div>
                            <button wire:click="create()" type="button" class="space-x-52 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Adicionar Novo Repasse
                            </button>
                        </div>
                    </div>
                @if($isModalOpen)
                    @include('livewire.repasses.create')
                @endif


                    <div class="overflow-x-auto relative">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Data recebimento
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Valor recebido
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Data repasse
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Valor do repasse
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Obs
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($repasses as $repasse)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ date("d/m/Y", strtotime($repasse->data_recebimento)) }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $repasse->valor_recebimento }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ date("d/m/Y", strtotime($repasse->data_repasse)) }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $repasse->valor_repasse }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $repasse->obs }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <button wire:click="edit({{ $repasse->id }})" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                            Edit</button>
                                        <button onclick="confirm('Você tem certeza que deseja excluir esse motorista? Será perdido todo o histórico de pagamentos!') || event.stopImmediatePropagation()"
                                                wire:click="delete({{ $repasse->id }})" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                            Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $repasses->links() }}
                    </div>
            </div>
        </div>
    </div>
</div>
