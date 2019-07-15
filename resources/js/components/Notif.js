import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import uuid from 'uuid';
import axios from 'axios';
import Moment from 'react-moment';
import moment from 'moment'

export default class Notif extends Component {
    constructor(props){
      super(props);
      this.state = {
        content:'',
        uuid:null,
        created_at:'',
        messages:[],
        users_id:'',
        unread:0,
      }
      this.handleClick = this.handleClick.bind(this);
    }
    componentDidMount() {
      axios.get('/notif').then(res => {
        // console.log('dari res');
        if (res.data.msg != undefined){
          this.setState(state => ({
            messages:res.data.msg.slice(0,5),
            users_id:res.data.users.id,
            unread:res.data.unread
          }));
        } else {
          console.log(res.data.msg);
        }
        // console.log(this.state);
      });
      // console.log(message);

      window.Echo.channel('laravel_database_public').listen('NotifSent',({message}) => {
        console.log(message);
        if (this.state.users_id == message.users_id || message.users_id == 0){
          if (message.oper == 'edit'){
            if("index" in message){
              this.state.messages[message.index].read=message.read;
              this.setState(state => ({
                unread:this.state.unread-1
              }))
            } else {
              this.state.messages.map((q,i) => {
                if (message.uuid === q.uuid)this.state.messages[i].content=message.content;
              });
            }
          } else if (message.oper == 'add'){
            delete message["oper"];
            this.state.messages.unshift(message);
            // console.log(this.state.messages);
            this.setState(state => ({
              unread:this.state.unread+1
            }))
            // console.log(this.state.messages);
          }
          this.setState(state => ({
            messages:this.state.messages.slice(0,5)
          }))
        }
      });

    }
    handleClick(e){
      e.preventDefault();
      // console.log(this.state.messages);
      var data = this.state.messages[e.currentTarget.dataset.id];
      // // delete data["created_at"];

      // console.log(data);
      if (data.read.indexOf(this.state.users_id)<0){

        data["updated_at"]=moment().format("Y-MM-DD HH:mm:ss");
        data["id"]=data.id;
        data["read"]=this.state.users_id+','+data.read;
        data["read"]=data.read;
        data["index"]=e.currentTarget.dataset.id;
        data["users_id"]=this.state.users_id;
        data["oper"]='edit';
        // console.log(data);
      //
        axios.post('/notif',data).then(res => {
          delete data["oper"];
          delete data["index"];
          if (res.data.users_id == data["users_id"]){
            this.setState(state => ({
              messages:this.state.messages.slice(0,5),
              unread:this.state.unread-1
            }))
          }

          // console.log(res.data.users_id);
        }).catch(err => console.log(err.response))
      }

    }

    render() {


      return (
        <React.Fragment>
          <a data-toggle="dropdown" className="dropdown-toggle" href="#">
            <i className={this.state.unread!=0 ? 'ace-icon fa fa-envelope icon-animated-vertical' : 'ace-icon fa fa-envelope'}></i>
            {this.state.unread!=0 ? <span className="badge badge-success">{this.state.unread}</span> : ""}
          </a>

          <ul className="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
            <li className="dropdown-header">
              <i className="ace-icon fa fa-envelope-o"></i>
               Messages
            </li>
            <li className="dropdown-content">
              <ul className="dropdown-menu dropdown-navbar">
              {
                this.state.messages.map((message,i) => (
                  <li key={message.uuid} data-id={i} onClick={this.handleClick}>
                    <a href="#" className="clearfix">
                      <img src="/public/images/avatars/avatar.png" className="msg-photo" alt="Alex's Avatar" />
                      <span className={message.read.indexOf(this.state.users_id)<0 ? "msg-body bg-info" : "msg-body"}>
                        <span className="msg-title">
                          <span className="blue">admin: </span>
                          {message.content}
                        </span>

                        <span className="msg-time">
                          <i className="ace-icon fa fa-clock-o"></i>
                          <span> <Moment unit="days" fromNow interval={1000}>{message.created_at}</Moment></span>
                        </span>
                      </span>
                    </a>
                  </li>
                ))
              }
              </ul>
            </li>
            <li className="dropdown-footer">
              <a href="inbox.html">
                See all messages
                <i className="ace-icon fa fa-arrow-right"></i>
              </a>
            </li>
          </ul>
        </React.Fragment>
      );
    }
}
if(document.getElementById('notif')){
    ReactDOM.render(<Notif/>,document.getElementById('notif'));
}
