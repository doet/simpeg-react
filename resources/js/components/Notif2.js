import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import uuid from 'uuid';
import axios from 'axios';

import Moment from 'react-moment';
import 'moment-timezone';

export default class Notif2 extends Component {
    constructor(props){
      super(props);
      this.state = {
        content:'',
        created_at:'',
        uuid:null,
        messages:[],
        unread:0,
        users_id:'',
      }
      this.handleChange = this.handleChange.bind(this);
      this.handleSubmit = this.handleSubmit.bind(this);
    }
    componentDidMount() {
      axios.get('/notif2').then(res => {
        // console.log(res.data);
        this.setState(state => ({
          messages:res.data
        }));
      });
      window.Echo.channel('public').listen('NotifSent',({message}) => {
        console.log('respon echo');
        this.setState(state => ({
          messages:[...state.messages,message],
          unread:this.state.unread+1,
        }))
      })
    }
    handleChange(e){
      this.setState({
        [e.target.name]:e.target.value
      })
    }
    handleSubmit(e){
      e.preventDefault();
      // var currenttime = new Date();
      const data = {
        content:this.state.content,
        uuid:uuid.v4(),
        created_at:Date.now(),
      }
      axios.post('/notif2',data).then(() => {
        this.setState(state => ({
          messages:[...state.messages,data],
          content:'',
          unread:this.state.unread+1,
        }))
        // console.log(messages);
      }).catch(err => console.log(err.response))
    }

    render() {
      console.log(this.state.messages);
      const date = new Date();
      return (
        <div className="container">
          {this.state.unread}
          <form onSubmit={this.handleSubmit}>
            <div className="form-group">
              <label htmlFor="exampleInputEmail1">Message</label>
              <input value={this.state.content} onChange={this.handleChange} type="text" className="form-control" id="exampleInputEmail1" name="content" />
              <small id="emailHelp" className="form-text text-muted">We'll Share your message!!</small>
            </div>
            <button type="submit" className="btn btn-primary">Send</button>
          </form>
          <div>
          {
            this.state.messages.length > 0 ?
                this.state.messages.map(message => (
                  <div key={message.uuid}>
                    {message.users_id} | {message.content} - <Moment unit="days" fromNow interval={1000}>{message.created_at}</Moment> {message.read!=0 ? '*' : ''}
                  </div>
                ))
            :
            <div className="alert alert-primary" role="alert">
              Pesan Akan Muncul, Silahkan buat pesan pertama :*
            </div>
          }
          </div>
        </div>
      );
    }
}
if(document.getElementById('notif2')){
    ReactDOM.render(<Notif2/>,document.getElementById('notif2'));
}
