import React from 'react';
import ReactDOM from 'react-dom';
import Swal from 'sweetalert2'

function Delete(props) {
    const destroy = async () => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(props.endpoint).then((response) => {
                    Swal.fire({
                        title: 'Success',
                        text: 'Your Data has Been Deleted',
                        confirmButtonText: `OK`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.replace('table');
                        }
                    })
                })
            }
        })
    }
    return (
        <button onClick={destroy} className="btn btn-outline-danger">Delete</button>
    );
}

export default Delete;

if (document.querySelectorAll('.delete')) {
    const deleteNodes = document.querySelectorAll('.delete')
    deleteNodes.forEach((item) => {
        ReactDOM.render(<Delete endpoint={item.getAttribute('endpoint')} />, item);
    })
}
