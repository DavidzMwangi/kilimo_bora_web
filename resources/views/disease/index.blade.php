@extends('layouts.master')


@section('style')
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">

@endsection
@section('content')
    <section class="content-header">
        <h1>
            Data Tables
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" id="work_area">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">New Sub County</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" v-on:submit.prevent="saveData" name="disease_form">
                                    {{--<div class="col-md-4">--}}
                                        {{--<label>Sub County Name</label>--}}
                                        {{--<input name="sub_county_name" class="form-control" id="sub_county_name" placeholder="Sub County Name" required>--}}
                                    {{--</div>--}}


                                    <div class="col-md-3">
                                        <label for="counties">County Name</label>
                                        <select name="counties" id="counties" class="form-control" required onchange="getSubCounties(this.value)">
                                            <option disabled selected>Please select a county</option>
                                            @foreach($counties as $county)
                                                <option value="{{$county->id}}">{{$county->name}}</option>
                                            @endforeach
                                        </select>
                                        {{--<input name="sub_county_name" class="form-control" id="sub_county_name" placeholder="Sub County Name">--}}
                                    </div>


                                    <div class="col-md-3">
                                        <label for="sub_counties">Sub County Name</label>
                                        <select name="sub_counties" id="sub_counties" class="form-control" onchange="getSubCrops(this.value)">
                                            <option disabled selected>Please select a Sub-county</option>
                                            <option v-bind:value="sub_county.id" v-for="sub_county in sub_counties">@{{ sub_county.name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">

                                        <label for="county_crop">Crop Name</label>
                                        <select name="county_crop" id="county_crop" class="form-control" required>
                                            <option disabled selected>Please select a crop</option>
                                            <option v-bind:value="county_crop.id" v-for="county_crop in county_crops">@{{ county_crop.crop.name }}</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Disease Name</label>
                                        <input name="disease" class="form-control" id="disease" placeholder="Disease" required>
                                    </div>
                                    <div class="col-md-3">

                                        <button class="btn  btn-success" type="submit" id="save" style="margin-top: 25px">Save</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>




        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Table With Full Features</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Sub County Name</th>
                                <th>County Name</th>

                            </tr>
                            </thead>
                            <tbody>

                            {{--                            @foreach($subCounties as $sub_county)--}}
                            <tr v-for="disease in diseases ">
                                {{--<td>{{$sub_county->name}}</td>--}}
                                {{--<td>{{$sub_county->county->name}}</td>--}}
                                <td>@{{ disease.name }}</td>
                                <td>@{{ disease.id }}</td>
                            </tr>
                            {{--@endfo/reach--}}

                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('script')
    {{--<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>--}}
    {{--<script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>--}}

    {{--<script>--}}
    {{--$(function () {--}}
    {{--$("#example1").DataTable();--}}
    {{--$('#example2').DataTable({--}}
    {{--"paging": true,--}}
    {{--"lengthChange": false,--}}
    {{--"searching": false,--}}
    {{--"ordering": true,--}}
    {{--"info": true,--}}
    {{--"autoWidth": false--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
<script>
    function getSubCounties(county_id) {
        let url23='{{route('get_sub_county_for_crop')}}';
        axios.post(url23,{'county_id':county_id})
            .then(res=>{
               shitment.sub_counties=res.data.sub_counties;

            })
    }

    function getSubCrops(sub_county_id) {
        let url33='{{route('sub_county_diseases')}}';
        axios.post(url33,{'sub_county_id':sub_county_id})
            .then(res=>{
                shitment.county_crops=res.data.county_crops
            })
    }
</script>
    <script>
        let shitment=new Vue({
            el:'#work_area',
            data:{
                sub_counties:[],
                county_crops:[],
                diseases:[]
            },
            created:function () {
                {{--let url1='{{route('all_sub_counties')}}';--}}
                {{--axios.get(url1)--}}
                    {{--.then(res=>{--}}
                        {{--this.sub_counties=res.data.sub_counties;--}}
                    {{--})--}}
            },
            methods: {
                saveData:function () {
                    let me=this;
                    let form=document.forms.namedItem("disease_form");

                    let formData=new FormData(form);

                    //clear the input tag
                    $('#sub_county_name').val('');
                    let url='{{route('save_new_disease')}}';

                    axios.post(url,formData)
                        .then(res=>{
                            me.diseases=res.data.diseases;
                        })
                        .catch(err=>{
                            // console.log(err)
                        })
                }
            }

        })
    </script>
@endsection
