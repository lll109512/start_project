<template lang="html">
    <div>
        <div class="form-group d-flex justify-content-between">
           <h3>Passengers</h3>
           <button type="button" class="btn btn-primary" name="button" id="add_pass_btn" @click="addOne">Add passenger</button>
        </div>
        <div v-for="i in bookings">
            <div class="form-group">
              <fieldset class="passengers_wrapper">
                <div class="passenger_wrapper">
                   <!-- <input type="hidden" :name="passengers[id][i]" class="passenger_id_input" value=""> -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">
                                    Given Name:
                                </label>
                                <div class="col-lg-8">
                                    <input class="form-control form-control-sm given_:name_validator" :name="'given_name['+i+']'">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">
                                    Surname:
                                </label>

                                <div class="col-lg-8">
                                    <input class="form-control form-control-sm surname_validator"  :name="'surname['+i+']'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">
                                    Email:
                                </label>

                                <div class="col-lg-8">
                                    <input class="form-control form-control-sm email_validator" type="email"  :name="'email['+i+']'">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">
                                    Mobile:
                                </label>

                                <div class="col-lg-8">
                                    <input class="form-control form-control-sm mobile_validator"  :name="'mobile['+i+']'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">
                                    Passport:
                                </label>

                                <div class="col-lg-8">
                                    <input class="form-control form-control-sm passport_validator"  :name="'passport['+i+']'">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">
                                    Date of Birth:
                                </label>

                                <div class="col-lg-8">
                                    <input class="form-control form-control-sm birth_date_validator"  :name="'birth_date['+i+']'" data-provide="datepicker">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">
                                    Special Request:
                                </label>

                                <div class="col-lg-6">
                                    <input class="form-control form-control-sm"  :name="'special['+i+']'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <a href="javascript:void(0);" class="btn btn-danger remove_passenger" @click="removeOne(i)">Remove</a>
                    </div>
                    <hr />
                </div>
            </fieldset>
            </div>
        </div>
    </div>
</template>

<!-- <script src="{{asset('js/jquery.validate.js')}}"></script> -->
<script>
// import from 'js/jquery.validate.js';
export default {
    name:'BookingComponent',
    data(){
        return {
            bookings:[],
            counter:0
        }
    },
    methods:{
        addOne(){
            this.bookings.push(this.counter);
            this.counter+=1;
        },
        removeOne(index){
            this.bookings.splice(this.bookings.indexOf(index),1);
        }

    },
    mounted(){
        console.log("123");
        $("#bookingform").validate();
    }
}
</script>
