import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Tabel from './Tabel';

export default class EditNotif extends Component {
    constructor(props){
      super(props);

    }
    componentDidMount() {
    }

    render() {

      return (
        <React.Fragment>
          <Tabel/>
        </React.Fragment>
      );

    }
}

if(document.getElementById('editnotif')){
    ReactDOM.render(<EditNotif/>,document.getElementById('editnotif'));
}
