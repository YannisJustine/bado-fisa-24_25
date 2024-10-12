<div id="default-tab-content" class="w-full ml-5 mr-10">
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 w-full h-full flex flex-col" id="infos"
        role="tabpanel" aria-labelledby="infos-tab">
        <h3>
            <span class="text-2xl font-medium text-gray-800 dark:text-gray-100 hover:underline">Informations</span>
        </h3>
        <div class="w-full grow">
            <div class="mx-auto max-w-lg flex flex-col h-full justify-evenly">
                <div class="mb-6">
                    <label for="firstname"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                    <input disabled type="text" id="firstname"
                        class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-logo-orange-500 focus:border-logo-orange-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500"
                        readonly value="{{ $user->prenom }}">
                </div>
                <div class="mb-6">
                    <label for="lastname"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                    <input disabled type="text" id="lastname"
                        class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-logo-orange-500 focus:border-logo-orange-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500"
                        readonly value="{{ $user->nom }}">
                </div>
                <div class="mb-6">
                    <label for="sec" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de
                        sécurité sociale</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path
                                    d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
                            </svg>
                        </div>
                        <input disabled id="sec" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-logo-orange-500 focus:border-logo-orange-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500"
                            value="{{ $user->num_securite_sociale }}">
                    </div>
                </div>
                <div class="mb-6">
                    <label for="phone"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <div class="relative ">
                        <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.4"
                                    d="m19 2-8.4 7.05a1 1 0 0 1-1.2 0L1 2m18 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1m18 0v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2" />
                            </svg>
                        </div>
                        <input disabled type="text" id="phone" aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-logo-orange-500 focus:border-logo-orange-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500"
                            value="{{ $user->email }}">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 w-full h-full" id="habilitations" role="tabpanel"
        aria-labelledby="habilitation-tab">
        <h3>
            <span class="text-2xl font-medium text-gray-800 dark:text-gray-100 hover:underline">Habilitations</span>
        </h3>


        <div class="relative overflow-x-auto mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-scroll">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Libellé permis
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user->typePermis as $permis)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $permis->libelle }}
                            </th>
                        </tr>
                    @empty
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Aucune habilitation
                            </th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800 w-full h-full block" id="planning" role="tabpanel"
        aria-labelledby="planning-tab">
        <h3>
            <span class="text-2xl font-medium text-gray-800 dark:text-gray-100 hover:underline">Planning</span>
        </h3>

        <div class="mt-4">
            <Suspense>
                <template #default>
                    <Planning :user="{{ $user->id }}" />
                </template>
                <!-- loading state via #fallback slot -->
                <template #fallback>
                    <div class="flex items-center">
                        <div role="status"
                            class=" mx-auto max-w-lg p-4 border border-gray-200 rounded shadow animate-pulse md:p-6 dark:border-gray-700">
                            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-32 mb-2.5"></div>
                            <div class="w-48 h-2 mb-10 bg-gray-200 rounded-full dark:bg-gray-700"></div>

                            <div class="grid grid-cols-5 gap-4">
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 h-14 w-14"></div>
                            </div>
                        </div>
                    </div>

                </template>
            </Suspense>
        </div>

    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 flex flex-col w-full h-full" id="heures" role="tabpanel"
        aria-labelledby="heures-tab">
        <h3 class="mb-4">
            <span class="text-2xl font-medium text-gray-800 dark:text-gray-100 hover:underline ">Leçons</span>
        </h3>
        <livewire:lecons-formateur />
    </div>
</div>
