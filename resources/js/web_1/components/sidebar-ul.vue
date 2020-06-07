<template>
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="#" class="nav-link">
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
        props: {
            lists: Array,
        },
        data() {
            return {

            }
        },
        mounted() {
            if(this.lists.length > 0){
                this.onListSelected(this.lists[0]);
            }
        },
        methods: {
            onListSelected(list){
                this.$emit('list-selected', list)
            }
        }
    }
</script>

<style scoped>

</style>
