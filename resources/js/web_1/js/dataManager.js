const GET_LISTS = '/api/list';
const GET_LIST_DATA = '/api/list/{listId}';
const DELETE_LIST = '/api/list/{listId}';
const UPDATE_LIST = '/api/list/{listId}';
const CREATE_LIST = '/api/list';
const UPDATE_LIST_ACTIVITIES_ORDER = '/api/list/{listId}/change-activities-order';
const UPDATE_LISTS_ORDER = '/api/list/change-order';

const DELETE_ACTIVITY = '/api/activity/{activityId}';
const UPDATE_ACTIVITY_STATE = '/api/activity/{activityId}/change-completed-state';
const CREATE_ACTIVITY = '/api/activity';
const GET_ACTIVITY = '/api/activity/{activityId}';
const UPDATE_ACTIVITY = '/api/activity/{activityId}';


export default new Vue({
    data: {
        user: {

        },
        lists: [],

        listsUpdated: new Date(0),

    },
    mounted(){

    },
    methods: {
        emitListsUpdated(){
            this.$emit('lists-updated', this.lists);
        },
        emitListUpdated(list){
            this.$emit('list-updated', list);
        },
        emitListCreated(list){
            this.$emit('list-created', list);
        },
        emitListDeleted(){
            this.$emit('list-deleted');
        },


        async getLists(){
            if(this.timePassed(this.listsUpdated, 120)){
                let response = await this.reqGetLists();
                if(this.hasStatus200(response)){
                    let newLists = []
                    const nowTime = new Date();
                    this.listsUpdated = nowTime;

                    for (let i = 0; i < response.data.length; ++i) {
                        let list = response.data[i];
                        list.reqUpdated = nowTime;
                        let newList = null;
                        if(this.lists.length > 0){
                            newList = this.lists.find(e => e.id === list.id);
                        }
                        if(newList){
                            Object.assign(newList, list);
                        }else{
                            newList = list
                        }
                        newLists.push(newList);
                    }

                    this.lists = newLists;
                    this.emitListsUpdated();
                }
            }
            return this.lists;
        },
        async getListData(listId){

        },
        async updateList(listId, name, description, todo){
            let response = await this.reqUpdateList(listId, name, description, todo);
            if(this.hasStatus200(response)){
                let index = this.lists.findIndex(x => x.id === listId);
                if(index !== -1){
                    this.lists[index] = Object.assign(this.lists[index], response.data);
                    this.emitListsUpdated();
                    this.emitListUpdated(this.lists[index]);
                    return 1;
                }
            }
            return -1;
        },
        async createList(name, description){
            let response = await this.reqCreateList(name, description);
            if(this.hasStatus200(response)){
                let index = this.lists.push(response.data);
                if(index > 0){
                    index -= 1;
                    this.emitListCreated(this.lists[index]);
                    return this.lists[index];
                }
            }
            return -1;
        },
        async deleteList(listId){
            let response = await this.reqDeleteList(listId);
            if(this.hasStatus200(response)){
                this.lists.splice(this.lists.findIndex(x => x.id === listId), 1);
                this.emitListDeleted();
                this.emitListsUpdated();
                return 1
            }
            return -1;
        },
        async updateListsOrder(idsOrder){

        },


        async deleteActivity(activityId){

        },

        async updateActivityState(activityId, state){

        },

        async updateListActivitiesOrder(listId, idsOrder){

        },

        async createActivity(name, listId, description) {

        },

        async getActivity(activityId) {

        },

        async updateActivity(activityId, name, description, listId) {

        },




        hasStatus200(response) {
            return response.status === 200
        },
        timePassed(lastDate, expectedSeconds) {
            console.log(!(Math.floor((new Date() - lastDate)/1000) < expectedSeconds))
            return !(Math.floor((new Date() - lastDate)/1000) < expectedSeconds);
        },

        reqGetLists(){
            return axios.get(GET_LISTS)
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },
        reqGetListData(listId){
            return axios.get(GET_LIST_DATA.replace('{listId}', listId), {})
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },
        reqUpdateList(listId, name, description, todo){
            let data = {};
            if(name != null){
                data.name = name;
            }
            if(description != null){
                data.description = description;
            }
            if(todo != null){
                data.todo = todo? 1 : 0;
            }
            return axios.post(UPDATE_LIST.replace('{listId}', listId), data)
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },
        reqCreateList(name, description){
            let data = {};
            data.name = name;
            data.description = description;
            return axios.post(CREATE_LIST, data)
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },
        reqDeleteList(listId){
            return axios.delete(DELETE_LIST.replace('{listId}', listId))
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },
        reqUpdateListsOrder(idsOrder){
            let data = {};
            data.data = idsOrder;
            return axios.post(UPDATE_LISTS_ORDER, data)
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },



        reqDeleteActivity(activityId){
            return axios.delete(DELETE_ACTIVITY.replace('{activityId}', activityId))
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },

        reqUpdateActivityState(activityId, state){
            let data = {};
            data.state = !!state;
            return axios.post(UPDATE_ACTIVITY_STATE.replace('{activityId}', activityId), data)
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },

        reqUpdateListActivitiesOrder(listId, idsOrder){
            let data = {};
            data.data = idsOrder;
            return axios.post(UPDATE_LIST_ACTIVITIES_ORDER.replace('{listId}', listId), data)
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },

        reqCreateActivity(name, listId, description) {
            let data = {
                name: name,
                listId: listId,
                description: description,
            };
            return axios.post(CREATE_ACTIVITY, data)
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },

        reqGetActivity(activityId) {
            return axios.get(GET_ACTIVITY.replace('{activityId}', activityId))
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },

        reqUpdateActivity(activityId, name, description, listId) {
            let data = {};
            if(name){
                data.name = name;
            }
            if(description){
                data.description = description;
            }
            if(listId){
                data.listId = listId;
            }
            return axios.post(UPDATE_ACTIVITY.replace('{activityId}', activityId), data)
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },

        onRequest(resp){
            // console.log(resp);
            return resp
        },
        onRequestError(err){
            console.error(err.response);
            return err;
        },

    }

})
