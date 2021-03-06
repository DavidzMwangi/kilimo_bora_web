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
                        <form action="" v-on:submit.prevent="saveData" name="sub_county_form">
                    <div class="col-md-4">
                        <label>Sub County Name</label>
                        <input name="sub_county_name" class="form-control" id="sub_county_name" placeholder="Sub County Name" required>
                    </div>


                        <div class="col-md-4">
                            <label for="counties">County Name</label>
                            <select name="counties" id="counties" class="form-control" required>
                                <option disabled selected>Please select a county</option>
                                @foreach($counties as $county)
                                    <option value="{{$county->id}}">{{$county->name}}</option>
                                    @endforeach
                            </select>
                            {{--<input name="sub_county_name" class="form-control" id="sub_county_name" placeholder="Sub County Name">--}}
                        </div>

                        <div class="col-md-4">

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
                                <tr v-for="sub_county in sub_counties ">
                                    {{--<td>{{$sub_county->name}}</td>--}}
                                    {{--<td>{{$sub_county->county->name}}</td>--}}
                                    <td>@{{ sub_county.name }}</td>
                                    <td>@{{ sub_county.county.name }}</td>
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
        $data=new Vue({
            el:'#work_area',
            data:{
                sub_counties:[],
            },
            created:function () {
                let url1='{{route('all_sub_counties')}}';
                axios.get(url1)
                    .then(res=>{
                        this.sub_counties=res.data.sub_counties;
                    })
            },
            methods: {
                saveData:function () {
        let me=this;
                    let form=document.forms.namedItem("sub_county_form");

                    let formData=new FormData(form);

                    //clear the input tag
                    $('#sub_county_name').val('');
                    let url='{{route('save_sub_county')}}';

                    axios.post(url,formData)
                        .then(res=>{
                        me.sub_counties=res.data.sub_counties;
                        })
                        .catch(err=>{
                            // console.log(err)
                        })
                }
            }

        })
    </script>
@endsection
