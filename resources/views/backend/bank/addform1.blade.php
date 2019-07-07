    <div id="my-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
    <!-- 01 Header Form-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="smaller lighter blue no-margin">Form Transaksi </h3>
                </div>
    <!-- 01 end heder form-->
    <!-- 02 body Form -->
                <div class="modal-body">
                    <form class="form-horizontal form-aktif" id="form-1" method="get">
                        {!! csrf_field() !!}
                        <input type="hidden" name="datatb" value="trxharian" />
                        <input type="hidden" id='oper' name="oper" value="add" />
                        <input type="hidden" id='id' name="id" value="" />
                        <div class="form-group">
                          <label class="col-3 col-sm-3 col-md-3 control-label no-padding-right">ID Trx :</label>
                          <div class="col-5 col-sm-5 col-md-5">
                            <input type="text" id="notrx" name="notrx" class="input-sm form-control"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-3 col-sm-3 col-md-3 control-label no-padding-right">Member :</label>
                          <div class="col-5 col-sm-5 col-md-5">
                                <select class="chosen-select " id="member" name="member" data-placeholder="Choose a State...">
                                    <option value=""></option>
                                </select>

                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-3 col-sm-3 col-md-3 control-label no-padding-right">Kode :</label>
                          <div class="col-5 col-sm-5 col-md-5">
                            <select class="chosen-select" id="kode" name="kode" data-placeholder="Choose a State...">
                                <option value="str">Setor</option>
                                <option value="trk">Tarik</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-3 col-sm-3 col-md-3 control-label no-padding-right">Tanggal :</label>
                          <div class="col-5 col-sm-5 col-md-5">
                            <div class="input-group input-group-sm">
                              <!-- <input type="text" id="date" name="date" class="input-sm form-control" />
                              <span class="input-group-addon"><i class="ace-icon fa fa-calendar"></i></span> -->

                              <input id="date-timepicker1" name="tanggal" type="text" class="input-sm form-control" />
                              <span class="input-group-addon">
                                  <i class="fa fa-clock-o bigger-110"></i>
                              </span>

                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-3 col-sm-3 col-md-3 control-label no-padding-right">Uraian :</label>
                          <div class="col-5 col-sm-5 col-md-5" class="red">
                              <textarea id="uraian" name="uraian" class="autosize-transition form-control"></textarea>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-3 col-sm-3 col-md-3 control-label no-padding-right" for="name">Nilai :</label>
                          <div class="col-5 col-sm-5 col-md-5">
                            <input type="text" id="nilai" name="nilai" value="" class="input-sm form-control"  style="text-align: right;" onkeyup="formatNumber(this);" onchange="formatNumber(this);"/>
                          </div>
                        </div>

                    </form>                  .
                </div>
    <!-- 02 end body Form -->
    <!-- 03 footer Form -->
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>Close
                    </button>
                    <button  class="btn btn-sm btn-danger pull-right" id='save' onclick="
                      saveGrid({
                        'url'   : '{{ url('/api/bank/save') }}',
                        'grid'  : '#grid-table',
                        'modal' : '#my-modal'
                      })">
                        <i class="ace-icon fa fa-floppy-o"></i>Save
                    </button>
                </div>
    <!-- 03 end footer Form -->
            </div>
        </div><!-- /.modal-dialog -->
    </div>
