<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dischi</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div id="app" class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-4">Lista di Dischi</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div v-for="disco in dischi" @click="mostraDettagli(disco)" class="bg-white p-4 rounded shadow cursor-pointer hover:bg-gray-200 transition">
                <h2 class="font-semibold">{{ disco.title }}</h2>
                <p class="text-gray-600">{{ disco.author }}</p>
                <img :src="disco.poster" alt="Poster" class="mt-2 w-full h-auto rounded">
            </div>
        </div>

        <div v-if="discoSelezionato" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-lg text-center">
                <h2 class="text-2xl font-semibold">{{ discoSelezionato.title }}</h2>
                <p><strong>Autore:</strong> {{ discoSelezionato.author }}</p>
                <p><strong>Anno:</strong> {{ discoSelezionato.year }}</p>
                <p><strong>Genere:</strong> {{ discoSelezionato.genre }}</p>
                <img :src="discoSelezionato.poster" alt="Poster" class="mt-2 w-48 h-auto rounded mx-auto">
                <button @click="discoSelezionato = null" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Chiudi</button>
            </div>
        </div>
    </div>

    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    dischi: [],
                    discoSelezionato: null
                };
            },
            mounted() {
                this.caricaDischi();
            },
            methods: {
                caricaDischi() {
                    axios.get('dischi.php')
                        .then(response => {
                            this.dischi = response.data;
                        })
                },
                mostraDettagli(disco) {
                    this.discoSelezionato = disco;
                }
            }
        }).mount('#app');
    </script>
</body>
</html>