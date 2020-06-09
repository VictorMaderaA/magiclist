<template>
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="" class="nav-link" v-on:click.stop.prevent="onCreateNewList()">
                <i class="fas fa-plus-circle"></i>
                <p>Create New List</p>
            </a>
        </li>

        <li class="nav-item" v-for="list in lists">
            <a href="" class="nav-link" v-on:click.stop.prevent="onListSelected(list)">
                <i class="far fa-circle nav-icon"></i>
                <p>{{list.name}}</p>
            </a>
        </li>

    </ul>
</template>

<script>
    export default {
        name: "sidebar-ul",
        data() {
            return {
                firstLoad: true,
                lists: null,
            }
        },
        methods: {
            showDefaultList(){
                if(this.lists.length > 0){
                    this.onListSelected(this.lists[0]);
                }
            },
            async loadLists(){
                let response = await this.reqListsData();
                if(response.status === 200){
                    this.lists = response.data;
                    if(this.firstLoad){
                        this.showDefaultList();
                        this.firstLoad = false;
                    }
                }else{
                    //TODO
                }
            },

            reqListsData: async function () {
                const URL = '/api/list/';
                return axios.get(URL, {})
                    .then(function (resp) {
                        // console.log(resp);
                        return resp;
                    })
                    .catch(function (err) {
                        // console.error(err.response);
                        return err;
                    });
            },

            onListSelected(list){
                this.$emit('list-selected', list)
            },
            onCreateNewList(){
                this.$emit('create-list');
            }
        }
    }
</script>

<style scoped>

</style>
