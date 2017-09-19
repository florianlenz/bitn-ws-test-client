<template>
    <div>
        <div class="row">
            <div class="col-sm-6">

                <input v-model="userSearchTerm">
                <button @click="searchUser">Search</button>

                <hr>

                <ul>
                    <li v-for="u in users">Username: {{u.pseudo}} | PubKey: {{u.pubKey}}</li>
                </ul>

            </div>

            <div class="col-sm-6">

                <h4 class="text-center page-header">Logs</h4>

                <ol>
                    <li v-for="l in logs">{{l}}</li>
                </ol>
            </div>
        </div>
    </div>
</template>

<script>

    const io = require('socket.io-client');

    export default {
        props: {
            pubKey: {
                required: true,
                type: String
            },
            privKey: {
                required: true,
                type: String
            },
            pseudo: {
                required: true,
                type: String
            }
        },
        data: function(){
            return {
                logs: [],
                userSearchTerm: '',
                users: []
            }
        },
        methods: {
            log: function(msg){
                this.logs.push(msg);
            },
            searchUser: function(){
                this.users = [];
                this.log("Event - search:user "+this.userSearchTerm);
                this.socket.emit('search:user', this.userSearchTerm);
            }
        },
        computed: {
            socket: function(){
                return io.connect('http://127.0.0.1:3833', {query: {pubKey: this.pubKey}});
            }
        },
        mounted: function(){

            this.socket.on('connect', function(){
                this.log('Connected');
            }.bind(this));

            //Display users
            this.socket.on('search-response:user', function(data){

                data = JSON.parse(data);

                this.logs.push('search-response:user: '+JSON.stringify(data));

                this.users = data.users;

            }.bind(this));

            //Returns friends that match the search term
            this.socket.on('search:user', function(data){

                data = JSON.parse(data);

                this.logs.push('Event - search:user '+JSON.stringify(data));

                if(this.pseudo === data.searchTerm){
                    data.users = [
                        {
                            pseudo: this.pseudo,
                            pubKey: this.pubKey
                        }
                    ];

                    this.socket.emit('search-response:user', JSON.stringify(data));
                }

            }.bind(this));

        }
    }
</script>
