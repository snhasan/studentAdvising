<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">Course Info</div>
                    
                    <div v-show="profile.type == 1" class="card-body col-md-12">
                        <div class="form-group">
                            <label class="py-2" for="course_title">Course Title</label>
                            <input type="text" placeholder="course_title" class="form-control" aria-label="course_title" aria-describedby="course_title" v-model="course_title">
                            <label class="py-2" for="class_code">Class Code</label>
                            <input type="text" placeholder="Class Code" class="form-control" aria-label="Class Code" aria-describedby="Class Code" v-model="class_code">
                            <label class="py-2" for="date">Date</label>
                            <input type="date" placeholder="Date" class="form-control" aria-label="Date" aria-describedby="Date" v-model="date">
                            <label class="py-2" for="room_no">Room No.</label>
                            <input type="text" placeholder="Room No." class="form-control" aria-label="Room No." aria-describedby="Room No." v-model="room_no">
                            <label class="py-2" for="building_no">Building No.</label>
                            <input type="text" placeholder="Building No." class="form-control" aria-label="Building No." aria-describedby="Building No." v-model="building_no">
                            <div class="input-group-append py-3">
                                <button v-if="!edit_course_id" type="button" class=" btn btn-info text-white" @click.prevent="saveCourse()"> Add</button>
                                <button v-else type="button" class=" btn btn-info text-white" @click.prevent="updateCourse()"> Update</button>
                            </div>
                            
                        </div>
                        <!-- reset all input -->
                        <button type="button" class="btn btn-sm float-right text-white" @click.prevent="resetCourse()">Reset</button>
                        <!-- Show All data -->
                        
                    </div>
                    <div v-show="profile.type == 0" class="card-body col-md-12">
                        <div class="form-group">
                            <label class="py-2" for="course_title">Course Title</label>
                            <input type="text" disabled placeholder="course_title" class="form-control" aria-label="course_title" aria-describedby="course_title" v-model="course_title">
                            <label class="py-2" for="class_code">Class Code</label>
                            <input type="text" disabled placeholder="Class Code" class="form-control" aria-label="Class Code" aria-describedby="Class Code" v-model="class_code">
                            <label class="py-2" for="date">Date</label>
                            <input type="date" disabled placeholder="Date" class="form-control" aria-label="Date" aria-describedby="Date" v-model="date">
                            <label class="py-2" for="room_no">Room No.</label>
                            <input type="text" disabled placeholder="Room No." class="form-control" aria-label="Room No." aria-describedby="Room No." v-model="room_no">
                            <label class="py-2" for="building_no">Building No.</label>
                            <input type="text" disabled placeholder="Building No." class="form-control" aria-label="Building No." aria-describedby="Building No." v-model="building_no">
                            <div class="input-group-append py-3">
                                <button v-if="edit_course_id" type="button" class=" btn btn-info text-white" @click.prevent="enrollCourse()"> Enroll</button>
                                <label class="py-2" vid="enroll_msg" for="enroll_msg"></label>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-header">Course List</div>
                    <div class="search-wrapper mt-4 px-3 panel-heading col-sm-12">
                        <input class="form-control" type="text" aria-describedby="searchQuery" v-model="searchQuery" @keyup.prevent="searchResult()" placeholder="Search" />
                    </div> 
                    <div class="card-body">
                        <table class="table mt-4">
                            <thead class="text-white">
                                <th>sl</th>
                                <th>Course Ttile</th>
                                <th>Class Code</th>
                                <th>Room No.</th>
                                <th>Building No</th>
                                <th>Date</th>
                                <th>Action</th>
                            </thead>  
                            <tbody>
                                <tr v-for="(course,index) in courses" :key="index">
                                    <td>{{++index}}</td>
                                    <td>{{course.course_title}}</td>
                                    <td>{{course.class_code}}</td>
                                    <td>{{course.room_no}}</td>
                                    <td>{{course.building_no}}</td>
                                    <td>{{course.date}}</td>
                                    <td v-show="profile.type == 1" style="cursor:pointer; " ><i  @click.prevent="deleteCourse(--index)" class="fa fa-trash-o px-2" aria-hidden="true"></i><i @click.prevent="editCourse(--index)" class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
                                    <td v-show="profile.type == 0" style="cursor:pointer; " ><i @click.prevent="editCourse(--index)" class="fa fa-sign-in" aria-hidden="true"></i></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<style>
    .card{
        background-color: #352f5b;
        color:aliceblue;
    }
    input[type=text],
    input[type=text]:focus{
    color: #fff;
    border: none;
    background-color: rgba(0, 0, 0, .2);
    }
    table{
        border: 1px solid white;
        border-top: 2px solid white;
    }
    td{
    background-color: #423a6f;
    color: #F8F9FA;
    border-width: 1px;
    }
    th{
    background-color: #423a6f;
    color: #F8F9FA;
    border-width: 1px;
    }
    .btn{
       background-color:  #352f5b;
    }
</style>

<script>
    export default {

        props:['profile'],

        data(){
            return {
                courses:[],
                course_title:'',
                class_code:'',
                date:'',
                room_no:'',
                building_no:'',
                edit_course_id:'',
                edit_index:'',
                searchQuery:'',
                enroll_msg:'',
            }
        },
        mounted() {
            axios.get('/get-courses').then((res) => {
                this.courses = res.data;
            }).catch((err) => {
                
            });
        },
        // methods for data manupulation
        methods:{
            saveCourse(){
                let data = {
                    course_title:this.course_title,
                    class_code:this.class_code,
                    date:this.date,
                    room_no:this.room_no,
                    building_no:this.building_no,
                }
                if(this.course_title.length > 0){

                    
                    axios.post('/add-course',data).then((res) => {
                        this.courses.push(res.data);
                        this.resetCourse();
                    }).catch((err) => {
                        
                    });
                }
            },
            deleteCourse(index){
                if(this.courses[index].id){
                    axios.get('/delete-course/'+this.courses[index].id).then((res) => {
                        this.courses.splice(index,1);
                        
                    }).catch((err) => {
                        
                    });
                    
                }
            },
            editCourse(index){
                if(this.courses[index].id){
                    this.course_title = this.courses[index].course_title;
                    this.class_code = this.courses[index].class_code;
                    this.room_no = this.courses[index].room_no;
                    this.building_no = this.courses[index].building_no;
                    this.date = this.courses[index].date;
                    this.edit_course_id = this.courses[index].id;
                    this.edit_index = index;
                }
            },
            updateCourse(){
                let data = {
                    course_title:this.course_title,
                    class_code:this.class_code,
                    date:this.date,
                    room_no:this.room_no,
                    building_no:this.building_no,
                }

                if(this.course_title.length > 0){

                    axios.post('/update-course/'+this.courses[this.edit_index].id,data).then((res) => {
                        this.courses[this.edit_index].course_title = res.data.course_title;
                        this.courses[this.edit_index].class_code = res.data.class_code;
                        this.courses[this.edit_index].room_no = res.data.room_no;
                        this.courses[this.edit_index].building_no = res.data.building_no;
                        this.courses[this.edit_index].date = res.data.date;
                        this.resetCourse();
                    }).catch((err) => {
                        
                    });
                }
            },
            resetCourse(){
                this.course_title='';
                this.class_code='';
                this.date='';
                this.room_no='';
                this.building_no='';
                this.edit_course_id='';
                this.edit_index='';
                this.searchQuery = '';
            },
            searchResult(){

                let data = {
                        searchQuery : this.searchQuery,
                    }
                axios.post('/get-search',data).then((res) => {
                    this.courses = res.data;
                }).catch((err) => {
                    
                });

            },
            enrollCourse(){

                let data = {
                    profile_id:this.profile.id,
                    course_title:this.course_title,
                    class_code:this.class_code,
                }

                if(this.course_title.length > 0){

                    axios.post('/enroll-course/'+this.courses[this.edit_index].id,data).then((res) => {
                        this.$toaster.success(res.data);
                    }).catch((err) => {
                        
                    });
                }

            }
        }
    }
</script>
