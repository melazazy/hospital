@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-heading">
                <h5 class="panel-title">Book Appointment</h5>
            </div>
            <div class="panel-body">
                <form action="/"  name="book" method="post" >
                    <div class="form-group">
                        <label for="DoctorSpecialization">Doctor Specialization
                        </label>
                        <select name="Doctorspecialization" class="form-control" onChange="getdoctor(this.value);" required="required">
                            <option value="">Select Specialization</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="doctor">
                            Doctors
                        </label>
                        <select name="doctor" class="form-control" id="doctor" onChange="getfee(this.value);" required="required">
                        <option value="">Select Doctor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="consultancyfees">
                            Consultancy Fees
                        </label>
                        <select name="fees" class="form-control" id="fees"  readonly>
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="AppointmentDate">Date & Time</label>
                    <input class="form-control datepicker" type="datetime-local" name="appdate"  required="required" data-date-format="yyyy-mm-dd">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-o btn-primary">
                        Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection











