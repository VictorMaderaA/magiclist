<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title align-middle">
                            Edit <strong>{{name}}</strong>
                        </h3>

                        <div class="card-tools">
                            <a class="btn btn-sm" v-on:click="onClickCancel">
                                <i class="fas fa-times text-red"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row justify-content-center">
                            <div class="co-10">
                                <p class="text-danger" v-if="message.danger">{{ message.danger }}</p>
                                <p class="text-success" v-if="message.success">{{ message.success }}</p>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <!-- text input -->
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" v-model="list.private"
                                               id="private" name="customRadio" value="true" style="cursor: pointer;">
                                        <label for="private" class="custom-control-label" style="cursor: pointer;">
                                            Private List
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-8">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="name">List Name</label>
                                    <input type="text" class="form-control" id="name" ref="inputName"
                                           v-on:keyup.enter="$refs.inputDescription.focus()"
                                           placeholder="Cooking List..." v-model="list.name">
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" id="description" ref="inputDescription"
                                              placeholder="Enter description..." v-model="list.description"
                                              v-on:keyup.ctrl.enter="onClickSave"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"
                                :disabled="!list.name" v-on:click="onClickSave">Save</button>
                        <button type="submit" class="btn btn-default float-right"
                                v-on:click="onClickCancel">Cancel</button>
                    </div>

                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->

    </div>
</template>

<script>
    import Manager from '../js/dataManager'

    export default {
        name: "edit-list",
        components: {
            Manager
        },
        props: {
            listId: Number,
        },
        data() {
            return {
                name: null,
                list: {
                    name: null,
                    description: null,
                    private: null,
                },
                message: {
                    danger: null,
                    success: null,
                },
            }
        },
        beforeMount() {
            if(this.list){
                this.loadListData();
            }
        },
        methods: {
            async loadListData(){
                let list = await Manager.getListData(this.listId);
                if(list) {
                    this.list = list;
                    this.name = this.list.name;
                }
            },

            async onClickSave(){
                if(!this.list.name){
                    this.$refs.inputName.focus();
                    return;
                }
                let response = await Manager.updateList(this.list.id, this.list.name, this.list.description, null, this.list.private);
                if(response){
                    this.message.success = 'Saved Successfully';
                    this.message.danger = null;
                }else{
                    this.message.success = null;
                    this.message.danger = 'Something went wrong when trying to update';
                }
            },

            onClickCancel(){
                this.$emit('cancel');
            }
        }
    }
</script>

<style scoped>

</style>
