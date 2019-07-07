import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import uuid from 'uuid';
import axios from 'axios';

export default class Message extends Component {
    constructor(props){
      super(props);
      this.state = {
        content:'',
        uuid:null,
        messages:[],
      }
      this.handleChange = this.handleChange.bind(this);
      this.handleSubmit = this.handleSubmit.bind(this);
    }
    componentDidMount() {
      axios.get('/react/public/message').then(res => this.setState({
        messages:res.data
      }));
      window.Echo.channel('laravel_database_public').listen('MessageSent',({message}) => {
        console.log('respon echo');
        this.setState(state => ({
          messages:[...state.messages,message]
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
      const data = {
        content:this.state.content,
        uuid:uuid.v4(),
      }
      axios.post('/react/public/message',data).then(() => {
        console.log(data);
        this.setState(state => ({
          messages:[...state.messages,data],
          content:''
        }))
      }).catch(err => console.log(err.response))
    }

    render() {
      return (
        <div className="container">
          <form onSubmit={this.handleSubmit}>
            <div className="form-group">
              <label htmlFor="exampleInputEmail1">Message</label>
              <input value={this.state.content} onChange={this.handleChange} type="text" className="form-control" id="exampleInputEmail1" name="content" />
              <small id="emailHelp" className="form-text text-muted">Pesan</small>
            </div>
            <button type="submit" className="btn btn-primary">Send</button>
          </form>
          <div className="mt-4">
          {
            this.state.messages.length > 0 ?
                this.state.messages.map(message => (
                    <div className="alert alert-light" key={message.uuid} role="alert">
                        {message.content}
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
if(document.getElementById('message')){
    ReactDOM.render(<Message/>,document.getElementById('message'));
}
