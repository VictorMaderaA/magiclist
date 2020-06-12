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
    },
    mounted(){

    },
    methods: {
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
        reqUpdateList(listId, name, description){
            let data = {};
            if(name){
                data.name = name;
            }
            if(description){
                data.description = description;
            }
            return axios.post(UPDATE_LIST.replace('{listId}', listId), data)
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },
        reqCreateList(name, description){
            let data = {};
            if(name){
                data.name = name;
            }
            if(description){
                data.description = description;
            }
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
