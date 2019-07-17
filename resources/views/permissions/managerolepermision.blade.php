@extends('layouts.common.main')
@section('content')
<?php 
$collection=collect($allmodules);
// echo '<pre>';
// print_r($collection);
$collection->search(function ($item, $key) {
    return $item > 5;
});
?>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header  with-border">
              <h3 class="box-title">Permissions</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                </div>
              </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table id="example2" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
              </table>
            </div>
            <!-- <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              </ul>
            </div> -->
            
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>
@endsection