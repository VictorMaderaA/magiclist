<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title align-middle">
                        Create New List
                    </h3>

                    <div class="card-tools">
                        <a class="btn btn-sm">
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
                                    <label for="name">List Name</label>
                                    <input type="text" class="form-control" id="name"
                                           placeholder="Cooking List...">
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" id="description"
                                              placeholder="Enter description..."></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="submit" class="btn btn-default float-right">Cancel</button>
                </div>

            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- ./row -->

</template>

<script>
    export default {
        name: "create-list"
    }
</script>

<style scoped>

</style>
