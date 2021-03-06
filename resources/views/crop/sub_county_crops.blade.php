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
                        <h3 class="box-title">Sub County Crop</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class=" col-md-6">
                                        <label for="counties">County Name</label>
                                        <select name="counties" id="counties" class="form-control" v-on:change="getSubCounty" onchange="getId(this.value)">
                                            <option disabled selected>Please select a county</option>
                                            @foreach($counties as $county)
                                                <option  value="{{$county->id}}">{{$county->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                <div class=" col-md-6">
                                    <label for="counties">Sub-County Name</label>
                                    <select name="sub_counties" id="sub_counties" class="form-control" v-on:change="getCrop" onchange="getChakula(this.value)">
                                        <option disabled selected>Please select a Sub County</option>

                                        <option  v-for="sub_county in sub_counties" v-bind:value="sub_county.id">@{{sub_county.name  }}</option>
                                    </select>
                                </div>

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


                            <tr v-for="crop_record in crops_records ">

                                <td>@{{ crop_record.sub_county.name }}</td>
                                <td>@{{ crop_record.crop.name }}</td>
                            </tr>

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

<script>

</script>
    <script>
        function getId(county_id) {
            window.countyId=county_id
        }
        function getChakula(sub_county_id) {
            window.subCountyId=sub_county_id;

        }

        $data=new Vue({
            el:'#work_area',
            data:{
                sub_counties:[],
                crops_records:[]
            },
            created:function () {

            },
            methods: {
                getSubCounty:function () {

                    let me=this;
                    me.sub_counties=[];
                    let url23='{{route('get_sub_county_for_crop')}}';
                    axios.post(url23,{'county_id':countyId})
                        .then(res=>{
                        me.sub_counties=res.data.sub_counties;



                        })
                },
                getCrop:function () {
                    let me1=this;

                    let url24='{{route('get_sub_county_crops')}}';
                    axios.post(url24,{"sub_county_id":subCountyId})
                        .then(res=>{
                            me1.crops_records=res.data.records;
                            //
                            // $.each(res.data.records,function (key,value) {
                            //     console.log(key)
                            // })
                        })
                }
            }

        })
    </script>
@endsection
