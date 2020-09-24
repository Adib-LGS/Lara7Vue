<template>
    <div class="container">
        <add-task @task-created="refresh" ></add-task>
           <ul class="list-group">
               <li class="list-group-item" v-for="task in tasks.data" :key="task.id">
                   <a href="#">{{ task.name }}</a>
                <div>
                    <button type="button" class="btn btn-secondary d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#editModal" @click="getTask(task.id)">
                        Edit
                    </button>
                    <button type="button" class="btn btn-danger" @click="deleteTask(task.id)">Delete</button>
                </div>
                </li>
                <edit-task v-bind:taskToEdit="taskToEdit" @task-updated="refresh"></edit-task>
           </ul>
           <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5">

           </pagination>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                tasks: {},
                taskToEdit: ''
            }
        },

        //Stock response of get request in tasks object
        created() {
            axios.get('http://127.0.0.1:8000/tasksList')
                .then(response => this.tasks = response.data)
                .catch(error => console.log(error));
        },

        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('http://127.0.0.1:8000/tasksList?page=' + page)
                    .then(response => {
                        this.tasks = response.data;
                    })
                    .catch(error => console.log(error));
            },

            getTask(id) {
                axios.get('http://127.0.0.1:8000/tasks/edit/' + id)
                    .then(response => this.taskToEdit = response.data)
                    .catch(error => console.log(error));
            },

            deleteTask(id) {
                axios.delete('http://127.0.0.1:8000/tasks/' + id)
                    .then(response => this.tasks = response.data)
                    .catch(error => console.log(error));
            },
            
            refresh(tasks) {
                this.tasks = tasks.data
            }
	    },
        

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
