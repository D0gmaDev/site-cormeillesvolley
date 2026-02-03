<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue';

const tarifs = [
    {
        categorie: 'Séniors compétition',
        annee: 'né(e) en 2004 et antérieurement',
        tarif: '280 €',
    },
    {
        categorie: 'Loisirs compétition / FSGT',
        annee: 'né(e) en 2004 et antérieurement',
        tarif: '220 €',
    },
    {
        categorie: 'Loisirs détente',
        annee: 'né(e) en 2004 et antérieurement',
        tarif: '220 €',
    },
    {
        categorie: 'M21 (-21 ans)',
        annee: 'né(e) en 2005, 2006 ou 2007',
        tarif: '250 €',
    },
    {
        categorie: 'M18 (-18 ans)',
        annee: 'né(e) en 2008, 2009 ou 2010',
        tarif: '240 €',
    },
    {
        categorie: 'M15 (-15 ans)',
        annee: 'né(e) en 2011 ou 2012',
        tarif: '230 €',
    },
    {
        categorie: 'M13 (-13 ans)',
        annee: 'né(e) en 2013 ou 2014',
        tarif: '220 €',
    },
    {
        categorie: 'M11 (-11 ans)',
        annee: 'né(e) en 2015 ou 2016',
        tarif: '220 €',
    },
    {
        categorie: 'M9 (-9 ans)',
        annee: 'né(e) en 2017 ou 2018',
        tarif: '190 €',
    },
    {
        categorie: 'Baby Volley M7 (-7 ans)',
        annee: 'né(e) en 2019 ou 2020',
        tarif: '180 €',
    },
    {
        categorie: 'Baby Volley M5 (-5 ans)',
        annee: 'né(e) en 2021 ou 2022',
        tarif: '180 €',
    },
];
</script>

<template>
    <PublicLayout title="Inscriptions">
        <!-- Hero -->
        <section class="bg-cardinal py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <h1
                    class="text-4xl font-extrabold tracking-tight text-white uppercase lg:text-5xl"
                >
                    <span class="inline-block bg-raisin px-3 py-1"
                        >Inscriptions</span
                    >
                </h1>
                <p class="mt-4 max-w-3xl text-lg text-white/90">
                    Bientôt la nouvelle saison sportive, il est temps de penser
                    à la rentrée ! Vous trouverez ci-après les modalités
                    d’inscription en ligne via la plateforme “MonClub”.
                </p>
            </div>
        </section>

        <!-- Content -->
        <section class="py-16">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <div class="grid grid-cols-1 gap-10 lg:grid-cols-12">
                    <!-- Main -->
                    <div class="lg:col-span-8">
                        <!-- Tarifs -->
                        <div
                            class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-black/5 sm:p-8"
                        >
                            <div
                                class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between"
                            >
                                <div>
                                    <h2
                                        class="text-2xl font-extrabold tracking-tight text-raisin uppercase"
                                    >
                                        Catégories d’âges et tarifs saison
                                        2025-2026
                                    </h2>
                                    <p class="mt-2 text-gray-600">
                                        Retrouvez ci-dessous la catégorie,
                                        l’année de naissance et le tarif
                                        associé.
                                    </p>
                                </div>
                                <div class="mt-4 sm:mt-0">
                                    <span
                                        class="inline-flex items-center rounded-full bg-cardinal/10 px-4 py-2 text-sm font-semibold text-cardinal ring-1 ring-cardinal/20"
                                    >
                                        Saison 2025-2026
                                    </span>
                                </div>
                            </div>

                            <!-- Table -->
                            <div
                                class="mt-6 overflow-hidden rounded-2xl ring-1 ring-black/5"
                            >
                                <div class="overflow-x-auto">
                                    <table
                                        class="min-w-full divide-y divide-gray-200"
                                    >
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4 text-left text-xs font-extrabold tracking-wider text-gray-600 uppercase"
                                                >
                                                    Catégorie
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4 text-left text-xs font-extrabold tracking-wider text-gray-600 uppercase"
                                                >
                                                    Année
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4 text-right text-xs font-extrabold tracking-wider text-gray-600 uppercase"
                                                >
                                                    Tarif 2025-2026
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody
                                            class="divide-y divide-gray-100 bg-white"
                                        >
                                            <tr
                                                v-for="(row, idx) in tarifs"
                                                :key="idx"
                                                class="transition-colors hover:bg-gray-50/70"
                                            >
                                                <td class="px-6 py-4">
                                                    <div
                                                        class="font-semibold text-raisin"
                                                    >
                                                        {{ row.categorie }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-4 text-gray-600"
                                                >
                                                    {{ row.annee }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 text-right"
                                                >
                                                    <span
                                                        class="inline-flex items-center rounded-full bg-raisin/10 px-3 py-1 text-sm font-bold text-raisin ring-1 ring-raisin/15"
                                                    >
                                                        {{ row.tarif }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Ristourne -->
                        <div
                            class="mt-10 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-black/5 sm:p-8"
                        >
                            <h2
                                class="text-2xl font-extrabold tracking-tight text-raisin uppercase"
                            >
                                Réduction familiale
                            </h2>

                            <div class="mt-4 space-y-4 text-gray-700">
                                <p>
                                    <span class="font-semibold"
                                        >Tarif dégressif :</span
                                    >
                                    20 € de réduction à partir de la seconde
                                    inscription appartenant au même foyer, avec
                                    le code
                                    <span class="font-bold text-cardinal"
                                        >FAMILLE2025</span
                                    >.
                                </p>

                                <div
                                    class="rounded-2xl bg-gray-50 p-5 ring-1 ring-black/5"
                                >
                                    <p class="font-semibold text-raisin">
                                        Exemple
                                    </p>
                                    <p class="mt-2 text-gray-700">
                                        1 frère M21 (250 €) et 1 sœur M15 (230€)
                                        -> 250€ + (230€ – 20€) = 460€
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Procédure -->
                        <div
                            class="mt-10 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-black/5 sm:p-8"
                        >
                            <h2
                                class="text-2xl font-extrabold tracking-tight text-raisin uppercase"
                            >
                                Procédure d'inscription
                            </h2>

                            <div class="mt-6 space-y-6 text-gray-700">
                                <div>
                                    <h3 class="text-lg font-bold text-raisin">
                                        Monclub (code club : acsc-volley95)
                                    </h3>
                                    <p class="mt-2">
                                        Nous utilisons depuis 2024 la solution
                                        MonClub afin de gérer les adhésions.
                                        Nous vous invitons donc à télécharger
                                        l’application mobile MonClub. (En cas de
                                        soucis avec la procédure d’inscription,
                                        n’hésitez pas à contacter le bureau par
                                        mail à
                                        <a
                                            href="mailto:contact@cormeillesvolley95.fr"
                                            class="font-semibold text-cardinal underline decoration-cardinal/40 underline-offset-4 hover:decoration-cardinal"
                                        >
                                            contact@cormeillesvolley95.fr
                                        </a>
                                        .
                                    </p>
                                </div>

                                <div class="border-l-4 border-cardinal pl-4">
                                    <h3 class="text-lg font-bold text-raisin">
                                        Certificat médical
                                    </h3>
                                    <p class="mt-2">
                                        La déclaration d’avoir répondu “NON” à
                                        toutes les questions du Questionnaire de
                                        santé (Majeur ou Mineur, voir
                                        ci-dessous) suffit à pratiquer le volley
                                        en compétition. Si vous répondez “OUI” à
                                        une des questions, vous devrez alors
                                        produire un certificat médical.
                                    </p>
                                    <p class="mt-3">
                                        Le certificat médical reste obligatoire
                                        dans le cadre d’un suclassement (à voir
                                        au cours de l’année avec l’entraîneur.
                                    </p>
                                </div>

                                <div
                                    class="rounded-2xl bg-gray-50 p-5 ring-1 ring-black/5"
                                >
                                    <h3 class="text-lg font-bold text-raisin">
                                        La cotisation annuelle
                                    </h3>
                                    <p class="mt-2">
                                        La cotisation se règle une fois que la
                                        préinscription sur MonClub est validée
                                        par le club avec tous les documents
                                        confirmes, préférentiellement
                                        directement sur MonClub (plusieurs
                                        solutions de paiement proposées), ou
                                        alors en main propre (pour les
                                        Pass’Sport par exemple) lors des
                                        permanences du secrétariat du début
                                        d’année.
                                    </p>
                                    <p class="mt-3">
                                        La cotisation est due, pleine et
                                        entière, peu importe la date de prise de
                                        licence. Vous pourrez demander ensuite
                                        un justificatif de cotisation par mail
                                        pour vous ou pour votre enfant à
                                        l’adresse
                                        <a
                                            href="mailto:contact@cormeillesvolley95.fr"
                                            class="font-semibold text-cardinal underline decoration-cardinal/40 underline-offset-4 hover:decoration-cardinal"
                                        >
                                            contact@cormeillesvolley95.fr
                                        </a>
                                        si vous en avez besoin.
                                    </p>
                                </div>

                                <div>
                                    <h3 class="text-lg font-bold text-raisin">
                                        Documents demandés sur MonClub (première
                                        inscription)
                                    </h3>
                                    <p class="mt-2">
                                        Photo d’identité, document d’identité
                                        (CNI recto verso ou passeport),
                                        Certificat Médical si nécessaire
                                    </p>
                                    <p class="mt-3">
                                        En cas de problème lors de
                                        l’inscription, ecrivez un mail à
                                        <a
                                            href="mailto:contact@cormeillesvolley95.fr"
                                            class="font-semibold text-cardinal underline decoration-cardinal/40 underline-offset-4 hover:decoration-cardinal"
                                        >
                                            contact@cormeillesvolley95.fr
                                        </a>
                                    </p>
                                </div>

                                <div
                                    class="rounded-2xl bg-cardinal/10 p-5 ring-1 ring-cardinal/20"
                                >
                                    <p class="font-semibold text-cardinal">
                                        Au-delà d’un délai maximum d’un mois
                                        sans dossier validé, l’adhérent ne
                                        pourra plus assister aux
                                        entraînements.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <aside class="lg:col-span-4">
                        <div class="sticky top-6 space-y-6">
                            <!-- Quick actions -->
                            <div
                                class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-black/5"
                            >
                                <h3
                                    class="text-lg font-extrabold tracking-tight text-raisin uppercase"
                                >
                                    À retenir
                                </h3>

                                <ul class="mt-4 space-y-3 text-gray-700">
                                    <li class="flex gap-3">
                                        <span
                                            class="mt-1 inline-block h-2 w-2 rounded-full bg-cardinal"
                                        ></span>
                                        <span
                                            >Inscription en ligne via
                                            MonClub</span
                                        >
                                    </li>
                                    <li class="flex gap-3">
                                        <span
                                            class="mt-1 inline-block h-2 w-2 rounded-full bg-cardinal"
                                        ></span>
                                        <span
                                            >Code club :
                                            <span class="font-bold"
                                                >acsc-volley95</span
                                            ></span
                                        >
                                    </li>
                                    <li class="flex gap-3">
                                        <span
                                            class="mt-1 inline-block h-2 w-2 rounded-full bg-cardinal"
                                        ></span>
                                        <span>
                                            Contact :
                                            <a
                                                href="mailto:contact@cormeillesvolley95.fr"
                                                class="font-semibold text-cardinal underline decoration-cardinal/40 underline-offset-4 hover:decoration-cardinal"
                                            >
                                                contact@cormeillesvolley95.fr
                                            </a>
                                        </span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Family code -->
                            <div class="rounded-2xl bg-raisin p-6 shadow-sm">
                                <h3
                                    class="text-lg font-extrabold tracking-tight text-white uppercase"
                                >
                                    Code Famille
                                </h3>
                                <p class="mt-3 text-white/90">
                                    20 € de réduction à partir de la seconde
                                    inscription du même foyer.
                                </p>

                                <div
                                    class="mt-4 rounded-2xl bg-white/10 px-4 py-3 text-center"
                                >
                                    <span
                                        class="text-xl font-extrabold tracking-widest text-white"
                                    >
                                        FAMILLE2025
                                    </span>
                                </div>
                            </div>

                            <!-- Note -->
                            <div
                                class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-black/5"
                            >
                                <h3
                                    class="text-lg font-extrabold tracking-tight text-raisin uppercase"
                                >
                                    Documents (1ère inscription)
                                </h3>
                                <div class="mt-4 space-y-2 text-gray-700">
                                    <p>• Photo d’identité</p>
                                    <p>
                                        • Document d’identité (CNI recto verso
                                        ou passeport)
                                    </p>
                                    <p>• Certificat Médical si nécessaire</p>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
