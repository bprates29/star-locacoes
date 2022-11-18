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
                @endif
                <button wire:click="create()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Adicionar Novo Motorista
                </button>
                @if($isModalOpen)
                    @include('livewire.motoristas.create')
                @endif
                <div class="overflow-x-auto relative">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Nome
                            </th>
                            <th scope="col" class="py-3 px-6">
                                CPF
                            </th>
                            <th scope="col" class="py-3 px-6">
                                CNH
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Telefone
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Obs
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($motoristas as $motorista)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $motorista->name }}
                                </th>
                                <td class="py-4 px-6">
                                    {{ $motorista->cpf }}
                                </td>
                                <td class="py-4 px-6">
                                    {{$motorista->cnh}}
                                </td>
                                <td class="py-4 px-6">
                                    {{$motorista->telefone}}
                                </td>
                                <td class="py-4 px-6">
                                    {{$motorista->obs}}
                                </td>
                                <td class="py-4 px-6">
                                    <button wire:click="edit({{ $motorista->id }})" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        Edit</button>
                                    <button onclick="confirm('Você tem certeza que deseja excluir esse motorista? Será perdido todo o histórico de pagamentos!') || event.stopImmediatePropagation()"
                                            wire:click="delete({{ $motorista->id }})" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        Delete</button>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    {{ $motoristas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
