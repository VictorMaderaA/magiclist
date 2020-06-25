<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title align-middle">
                            Create New List
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
                            <div class="col-sm-8">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="name">List Name</label>
                                    <input type="text" class="form-control" id="name" ref="inputName"
                                           v-on:keyup.enter="$refs.inputDescription.focus()"
                                           placeholder="Cooking List..." v-model="form.name">
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" id="description" ref="inputDescription"
                                              placeholder="Enter description..." v-model="form.description"
                                              v-on:keyup.ctrl.enter="onClickSave"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"
                                :disabled="!form.name" v-on:click="onClickSave">Save</button>
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
        name: "create-list",
        components: {
            Manager
        },
        data() {
            return {
                form: {
                    name: null,
                    description: '',
                }
            }
        },
        methods:{
            async onClickSave(){
                if(!this.form.name){
                    this.$refs.inputName.focus();
                    return;
                }
                await Manager.createList(this.form.name, this.form.description);
            },
            onClickCancel(){
                this.$emit('cancel');
            }
        }
    }
</script>

<style scoped>

</style>
