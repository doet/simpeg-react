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
      console.log(this.props.data);
      var dataSet = [
        [ "Tiger aja", "System Architect", "Edinburgh", "5421", "2011/04/25", "$320,800","Tiger Nixon", "System Architect", "Edinburgh", "5421", "2011/04/25", "$320,800"  ],
        [ "Garrett Winters", "Accountant", "Tokyo", "8422", "2011/07/25", "$170,750","Garrett Winters", "Accountant", "Tokyo", "8422", "2011/07/25", "$170,750"  ],
        [ "Ashton Cox", "Junior Technical Author", "San Francisco", "1562", "2009/01/12", "$86,000","Ashton Cox", "Junior Technical Author", "San Francisco", "1562", "2009/01/12", "$86,000"  ],
        [ "Cedric Kelly", "Senior Javascript Developer", "Edinburgh", "6224", "2012/03/29", "$433,060","Cedric Kelly", "Senior Javascript Developer", "Edinburgh", "6224", "2012/03/29", "$433,060"  ],
        [ "Airi Satou", "Accountant", "Tokyo", "5407", "2008/11/28", "$162,700","Airi Satou", "Accountant", "Tokyo", "5407", "2008/11/28", "$162,700"  ]
    ];
      this.$el = $(this.el)
      var myTable = this.$el.DataTable({
        data: dataSet,
        columns:[
          {title: "Name"},
          {title: "Position"},
          {title: "Office"},
          {title: "Extn"},
          {title: "Start date"},
          {title: "Salary"},
          {title: "Name2"},
          {title: "Position2"},
          {title: "Office2"},
          {title: "Extn2"},
          {title: "Start date2"},
          {title: "Salary2"}
        ],
        responsive: true,
        // buttons:true,
        bAutoWidth: false,
        // "aoColumns": [
        //   { "bSortable": false },
        //   '', null,null, null, null,
        //   { "bSortable": false }
        // ],
        "aaSorting": [],
        select: {
            // style: 'multi'
        }
      });

      $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
      new $.fn.dataTable.Buttons(myTable, {
          buttons: [
            // {
            //   "extend": "colvis",
            //   "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
            //   "className": "btn btn-white btn-primary btn-bold",
            //   columns: ':not(:first):not(:last)'
            // },
            {
              "extend": "copy",
              "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
              "className": "btn btn-white btn-primary btn-bold"
            },
            {
              "extend": "csv",
              "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
              "className": "btn btn-white btn-primary btn-bold"
            },
            {
              "extend": "excel",
              "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
              "className": "btn btn-white btn-primary btn-bold"
            },
            {
              "extend": "pdf",
              "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
              "className": "btn btn-white btn-primary btn-bold"
            },
            // {
            //   "extend": "print",
            //   "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
            //   "className": "btn btn-white btn-primary btn-bold",
            //   autoPrint: false,
            //   message: 'This print was produced using the Print button for DataTables'
            // }
          ]
      } );
      myTable.buttons().container().appendTo( $('.tableTools-container') );

      // console.log($('.t-child'));


      $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
          e.stopImmediatePropagation();
          e.stopPropagation();
          e.preventDefault();
      });
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
