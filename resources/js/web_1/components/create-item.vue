<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title align-middle">
                        Create New Item
                    </h3>

                    <div class="card-tools">
                        <a class="btn btn-sm" v-on:click="onClickCancel">
                            <i class="fas fa-times text-red"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form">
                        <div class="row justify-content-center">
                            <div class="col-sm-8">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="name">Item Name</label>
                                    <input type="text" class="form-control" id="name"
                                           placeholder="Date with Maruchan...">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="submit" class="btn btn-primary">Save & Create Other</button>
                    <button type="submit" class="btn btn-primary">Save & Edit</button>
                    <button type="submit" class="btn btn-default float-right"
                            v-on:click="onClickCancel">Cancel</button>
                </div>

            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- ./row -->

</template>

<script>
    export default {
        name: "create-item",
        data(){
            return{

            }
        },

        methods:{
            onClickCancel(){
                this.$emit('cancel');
            }
        }
    }
</script>

<style scoped>

</style>
