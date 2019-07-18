@extends('layouts.common.main')
@section('content')

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header  with-border">
              <h3 class="box-title">Permissions   <small>Check All</small> &nbsp; <button type="button" class="btn btn-default btn-sm checkbox-toggle-all"><i class="fa fa-square-o"></i>
                              </button></h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                </div>
              </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <ul class="timeline timeline-inverse ">
                  <!-- timeline time label -->
                  <li>
                     
                  </li>
               <?php  
                $i = 0 ;
                $pattern = '/(.*?[a-z]{1})([A-Z]{1}.*?)/';
                $replace = '${1} ${2}';
                ?>
                @if($allmodules)
                  @forelse ($allmodules as $key=>$eachmodule)
                     @php $iconclas='' @endphp
                            @if(($i % 2) != 0)
                                @php $iconclas="bg-aqua"@endphp
                            @endif
                     
                          <li>

                            <i class="fa fa-user {{ $iconclas }}"></i>

                            <div class="timeline-item">

                              <h3 class="timeline-header"> 
                              <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                              </button>
                              <a href="#">{{ preg_replace($pattern, $replace, $key) }}</a></h3>

                              <div class="timeline-body permission-table comment-text clearfix"  style="background: #fff">
                                  @forelse ($eachmodule as $key=>$eachmoduleitems)
                                     <div class="form-group ">
                                        <!-- <label> -->
                                       <p class="text-light-blue" style="border-bottom: 1px solid #d2d6de;margin-bottom: 10px;padding-bottom: 5px;font-weight: 600;color: #857d89 !important">   <input type="checkbox" class="minimal " > &nbsp;
                                         <span class="text"> {{  ucfirst($eachmoduleitems['method']) }}</span>
                                          </p>
                                        <!-- </label> -->
                                     </div>
                                  @empty
                                          <li>
                                               <div class="timeline-item">
                                               No Modules defined
                                               </div>
                                          </li>
                                 @endforelse
                              </div>
                              
                            </div>
                          </li>
                            @php $i=$i+1 @endphp
                    @empty
                            <li>
                     <div class="timeline-item">
                     No Modules defined
                     </div>
                  </li>
                   @endforelse
                   @else
                     <li>
                       <div class="timeline-item">
                       No Modules defined
                       </div>
                    </li>
                   @endif

                 @if(count($allmodules)>0)
                   <li>
                  </li>
                 @endif
                  <!-- END timeline item -->
                  <!-- timeline item -->
               
                  <!-- END timeline item -->
               
                </ul>
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
<script type="text/javascript">
   
</script>