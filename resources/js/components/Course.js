import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

export default class Course extends Component {
    constructor(){
        super();
        this.state = {
            courses: []
        }
    }

    componentWillMount(){
        axios.get('/api/class').then(response => {
            this.setState({
                courses: response.data
            });
        }).catch(errors => {
            console.log(errors);
        })
    }

    render() {
        return (
            <div className="container">
                <table className="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Length</th>
                            <th>Starting at</th>
                            <th>Difficulty</th>
                            <th>Capacity</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        {this.state.courses.map(course => 
                        <tr>
                            <td id={course.id+course.class_name}>{course.id}</td>
                            <td>{course.class_name}</td>
                            <td>{course.class_length}</td>
                            <td>{course.start_at}</td>
                            <td>{course.difficulty}</td>
                            <td>{course.capacity}</td>
                        </tr>
                        )}
                    </tbody>
                </table>
            </div>
        );
    }
}



if (document.getElementById('example')) {
    console.log("täällä");
    console.log(("1 tä äl lä").trim());
    ReactDOM.render(<Course />, document.getElementById('example'));
}
else {
    console.log("naaah");
}
