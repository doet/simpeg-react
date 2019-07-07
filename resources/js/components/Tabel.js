import '../../../public/css/responsive.dataTables.min.css'
import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import DataTable from 'datatables.net-bs';
require( 'datatables.net-buttons-bs' );
require( 'datatables.net-responsive-bs' );
require( 'datatables.net-select-bs' );

require( 'datatables.net-buttons/js/buttons.colVis.js' );
require( 'datatables.net-buttons/js/buttons.flash.js' );
require( 'datatables.net-buttons/js/buttons.html5.js' );
require( 'datatables.net-buttons/js/buttons.print.js' );

var $  = require( 'jquery' );
// var dt = require( 'datatables.net' )( window );

import uuid from 'uuid';
import axios from 'axios';

import Moment from 'react-moment';
import 'moment-timezone';

export default class Tabel extends Component {
    constructor(props){
      super(props);
    }
    componentDidMount() {
      // .parent())
      //
      // cols.splice(2, 0, {title: "Col-1", sTitle: "Col-1"});

      axios.post('/api/notification/json').then(res => {
        this.initDT(res.data);
      });
    }

    initDT(option){
      this.$el = $(this.el);
      var myTable = this.$el.DataTable({
        // data: option.body,
        // columns:option.head,
        columns:[
          {'title':'id'},
          {'title':'uuid'},
          {'title':'user'},
          {'title':'Content'},
          {'title':'Read'},
        ],
        ajax: {
          "url" : "/api/notification/json",
         "type": "POST",
         dataSrc: "body"
         // "data" : {
         //    "cmd" : "refresh",
         //    "from": 2,
         //    "to"  : 1
         //  }
        },
        // dom: '<"top row"<"class=.col-xs-12"f>>rt<"bottom row"<"class=.col-xs-4"l><"class=.col-xs-4"i><"class=.col-xs-4"p>><"clear">',
        dom: '<"top row"<"class=.col-xs-6"B><"class=.col-xs-6"f>>rt<"bottom row"<"class=.col-xs-4"l><"class=.col-xs-4"i><"class=.col-xs-4"p>>',
        buttons: [
          'copy',
          'csv',
          'excel',
          {
            text: 'Cuz',
            className: 'btn btn-default buttons-csv buttons-html5',
            action: function ( e, dt, node, config ) {
              // alert( 'Button activated' );
              myTable.data.reload();
            }
          },
        ],
        responsive: true,
        bAutoWidth: false,
        columnDefs: [
          {
            "targets": [ 1 ],
            "visible": false,
            // "searchable": false
          },
        ],
        "aaSorting": [],
        select: {
            // style: 'multi'
        }
      });
      // if ('hide' in option){
      //   option.hide.map(function(item, i){
      //     console.log(item);
      //     var column = myTable.column(item);
      //      column.visible( ! column.visible() );
      //   })
      // }
      // this.$el.parent().attr('class','');
      // console.log( )
    }

    render() {

      return (
        <React.Fragment>
          <table className="table table-striped table-bordered table-hover" style={{width: '100%'}} ref={el => this.el = el}>

          </table>
        </React.Fragment>
      );

    }
}
if(document.getElementById('tabel')){
    ReactDOM.render(<Tabel/>,document.getElementById('tabel'));
}
