import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import moment from 'moment';
import {DayPilot, DayPilotCalendar} from "daypilot-pro-react";

const qs = require('querystring');
var userID = parseInt(document.querySelector('#calendar').dataset.userId);
console.log('userID: ' + userID);
const config = {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }


export default class Course extends Component {

    constructor(props){
        super(props);
        this.state = {
            courses: [],
            one: [],
            bookings: [],
            users: [],
            classes: [],
            class: '',
            date: '',
            endDate: '',
            duration: '',
            group: ''
        }
        this.searchClass = this.searchClass.bind(this);
        this.showClass = this.showClass.bind(this);
        this.countBookings = this.countBookings.bind(this);
        this.addClass = this.addClass.bind(this);
        //this.cancelButton = this.cancelButton.bind(this);
        //this.cancelClass = this.cancelClass.bind(this);
        //this.handleClassNameChange = this.handleClassNameChange.bind(this);
        //this.handleClassDateChange = this.handleClassDateChange.bind(this);
    }

    componentDidMount(){
        Promise.all([
            axios.get('/api/calendar'),
            axios.get('/api/booking'),
            axios.get('/api/users'),
            axios.get('/api/class')
        ]).then(results => {
            console.log(results);
            var group = '';
            results[2].data.map(user => {
                if(user.id == userID){
                    group = user.group;
                }
            });
            this.setState({
                courses: results[0].data,
                bookings: results[1].data,
                users: results[2].data,
                classes: results[3].data,
                group: group
            });
        }).catch(errors => {
                console.log(errors);
    });
    }

    componentDidUpdate(prevProps, prevState) {
        if (this.state.class > prevState.class) {
            //console.log(this.state.class);  
        }
        if (this.state.endDate > prevState.endDate) {
            console.log(this.state.endDate);  
        }
    }

    countBookings(id) {
        var count = 0;
        this.state.bookings.map(booking => {
            if(booking.class_is_available_id == id){
                count += 1;
            }
        });
        return count;
    }

    searchClass(e){
        let url = '/api/calendar/' + e.target.value;
        axios.get(url).then(response => {
            this.setState({
                courses: response.data
            });
        }).catch(errors => {
            console.log(errors);
        })
    }

    handleClassNameChange(e){
        console.log('e.target.value name: ' + e.target.value);
        this.setState({
            class: e.target.value
        }, () => {
            console.log('class to add: ');
            console.log(this.state.class);
            console.log(this.state);
        });
        
    }

    handleClassDateChange(e){
        this.setState({
            date: moment(e.target.value, "YYYY-MM-DDTHH:mm").format('YYYY-MM-DD HH:mm:ss')
        });
        console.log('date: '+this.state.date);
    }

    handleEndDateChange(e){
        this.setState({
            endDate: moment(this.state.date, "YYYY-MM-DDTHH:mm").add('minutes', e.target.value).format('YYYY-MM-DD HH:mm:ss'),
            duration: e.target.value
        });
        console.log('end date: ' + this.state.endDate);
    }

    handleSubmit(e){
        e.preventDefault();

        var isTimeTaken = false;
        this.state.courses.map(course => {
            if((moment(this.state.date) >= moment(course.start) && moment(this.state.date) < moment(course.end)) || 
                (moment(this.state.endDate) > moment(course.start) && moment(this.state.endDate) <= moment(course.end))){
                console.log(moment(this.state.date));
                console.log(moment(course.start));
                console.log(moment(course.end));
                isTimeTaken = true;
            }
        });

        if(moment(this.state.date) < moment().add('days', 1)){
            alert("Invalid date or you are trying to add a class within next 24h");
            
        }
        else if( this.state.duration == ''){
            console.log(this.state.endDate);
            alert('Enter Date');
        }
        else if(parseInt(this.state.duration) < 30 || parseInt(this.state.duration) > 90){
            alert('Duration: from 30min up to 90min');
        }
        else if(this.state.class == ''){
            alert("Please select the class");
        }
        else if(isTimeTaken){
            alert("Classes cannot overlap");
        }
        else {
            console.log(this.state);
            var post = {
                teacher_id: userID,
                class_id: parseInt(this.state.class),
                start_time: this.state.date,
                end_time: this.state.endDate
            }
            console.log(post);
            axios.post('/api/class_is_available', qs.stringify(post), config).then(response => {
                console.log(response);
                
            }).then(error => {
                console.log(error);
            });

            location.reload();
        }
        
    }

/*     cancelButton(id){
        return this.state.users.map((user, index) => {
            
            if (user.id == userID && user.group == 'master' ||
            user.id == userID && user.group == 'admin')
                {
                    console.log("cancelButton: " + id);
                    return <button key={index} className="btn btn-primary" onClick={this.cancelClass(id)}>Cancel</button>
                }
        })
    }

    cancelClass(id){
        axios.delete('/api/class_is_available/' + id).then(response => {
            console.log(response);
        }).catch(errors => {
            console.log(id);
            console.log(errors);
        });
    } */

    addClass() {
        const mystyle = {
            backgroundColor: "pink",
            padding: "15px",
            borderRadius: "10px",
            marginBottom: "10px",
        };
        const eStyle = {
            margin: "5px"
        };
        if(this.state.group == null || isNaN(userID)){
            return null;
        }
        else {
            console.log(userID);
            return (
                <div style={mystyle}>
                <h2>Add new class</h2>
                    <form onSubmit={this.handleSubmit.bind(this)}>
                    Select class
                    <select name="class" onChange={this.handleClassNameChange.bind(this)} style={eStyle}>
                    <option>Select class</option>
                        {
                            this.state.classes.map((i, index) => 
                                <option key={index} value={i.id}>{i.class_name}</option>
                                            
                            )}
                    </select>
                    <br />
                    Select date <input name="date" style={eStyle} type="datetime-local" onChange={this.handleClassDateChange.bind(this)} />
                    <br />
                    Duration <input name="duration" style={eStyle} type="number" onChange={this.handleEndDateChange.bind(this)} />
                    <br />
                    <button type="submit" className="btn btn-primary">Add</button>
                    </form>
                </div>
            )
        }
        }  

    

    showClass(id){
        
        var content = document.getElementById('info');
        
        let url = '/api/course/' + id;
        axios.get(url).then(response => {
            console.log(response);
            this.setState({
                one: response.data
            });
            response.data.map(item =>{
            content.innerHTML = "";
            var h3 = document.createElement("h3");
            var pTime = document.createElement("p");
            var pDesc = document.createElement("p");
            var pDuration = document.createElement("p");
            var pTeacher = document.createElement("p");
            
            var dur = ((new Date(item.end) - new Date(item.start))/60000+'min');

            h3.appendChild(document.createTextNode(item.class.toString()));
            pTime.appendChild(document.createTextNode('From: ' + new Date(item.start).toDateString() + ', To: ' + new Date(item.end).toDateString()));
            pTime.style.margin = "0px";
            pDesc.appendChild(document.createTextNode('Description:\n' + item.description));
            pDesc.style.margin = "0px";
            pDuration.appendChild(document.createTextNode('Duration: ' + dur));
            pDuration.style.margin = "0px";
            pTeacher.appendChild(document.createTextNode('Teacher: ' + item.teacher));
            pTeacher.style.margin = "0px";

            //==========TAKE CLASS BUTTON=============
            var takeClassButton = document.createElement("button");
            takeClassButton.appendChild(document.createTextNode('Take Class'));
            takeClassButton.className = "btn btn-primary";
            takeClassButton.style.marginTop = "10px";
            takeClassButton.onclick = function () {
                

                var post = {
                    user_id: parseInt(document.querySelector('#calendar').dataset.userId),
                    class_is_available_id: item.id
                }
                axios.post('/api/booking', qs.stringify(post), config).then(response => {
                    console.log(response);
                    
                }).then(error => {
                    console.log(error);
                });
                content.removeChild(takeClassButton);
                location.reload();
            }

            content.appendChild(h3);
            content.appendChild(pTeacher);
            content.appendChild(pTime);
            content.appendChild(pDuration);
            content.appendChild(pDesc);
            content.style.backgroundColor = 'gray';
            content.style.color = 'white';
            content.style.padding = '20px';
            content.style.borderRadius = '15px';
            content.style.marginBottom = '15px';
            content.style.marginRight = '15px';

            var isInClass = false;
            this.state.bookings.map(booking => {
                if (booking.user_id == userID && id == booking.class_is_available_id){
                    isInClass = true;
                }
            });
            console.log("1");
            var isBanned = false;
            this.state.users.map(user => {
                console.log('user.name: ' + user.name);
                console.log('user.id: ' + user.id);
                console.log('user.status: ' + user.status);
                console.log('userID: ' + userID);
                if(user.id == userID && user.status == 'BANNED'){
                    console.log("täällä banned")
                    isBanned = true;
                }
            });
            if(isBanned){
                var p = document.createElement('p');
                p.appendChild(document.createTextNode('You have been banned! Naughty!'));
                p.style.color = 'red';
                content.appendChild(p);
            }
            if(document.getElementById('calendar').className == '40520' && isInClass == false && !isBanned){
                content.appendChild(takeClassButton);
            }
            else {
                if(!isBanned){
                var pYouAreIn = document.createElement('p');
                pYouAreIn.appendChild(document.createTextNode('You have already booked this class!'));
                pYouAreIn.style.color = 'red';
                content.appendChild(pYouAreIn);
                }
            }
            content.style.marginBottom = "20px";
            });
        }).catch(errors => {
            console.log(errors);
        });
        
        var node = document.createTextNode(this.state.one);
        
        //this.setState();
        window.scrollTo(0,0);
    }

    render() {
        return (
            <div className="row">
            <div id="info" className="col-xs-6"></div>

            <div id="addClass" className="col-xs-6">
                {this.addClass()}
            </div>
            <div className="col-xs-6">
            <h2>Upcoming classes</h2>
            <input type="text" className="input" onInput={this.searchClass} placeholder="Search by class name.."></input>
                <table className="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Teacher</th>
                            <th>Start time</th>
                            <th>End time</th>
                            <th>Duration</th>
                            <th>Capacity</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        {this.state.courses.map((course, index) => {
                            //console.log(this.state.courses);
                            if(new Date(course.start) > new Date())
                            return (
                                <tr key={index} id={course.id} onClick={()=>this.showClass(course.id)}>
                                    <td>{course.class}</td>
                                    <td>{course.teacher}</td>
                                    <td>{moment(course.start).format('MMMM Do YYYY, HH:mm:ss')}</td>
                                    <td>{moment(course.end).format('MMMM Do YYYY, HH:mm:ss')}</td>
                                    <td>{((new Date(course.end) - new Date(course.start))/60000+'min')}</td>
                                    <td>{this.countBookings(course.id)}/{course.capacity}</td>
                                </tr>
                            )}
                        )}
                    </tbody>
                </table>
                </div>

                
            </div>
            
        );
    }
}

if (document.getElementById('calendar')) {
    ReactDOM.render(<Course />, document.getElementById('calendar'));
}
else {
    console.log("naaah");
}
