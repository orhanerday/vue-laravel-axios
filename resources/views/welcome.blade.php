<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
</head>
<body>

<div id="app">
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container">
                <nav class="navbar">
                    <span class="navbar-brand mb-0 h1">


                         Add New Car</span>
                </nav>
                <div class="row">
                    <div class="col-12">


                        <div class="alert alert-danger" role="alert" v-bind:class="{hidden: hasError}">
                            All fields are required!
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Brand</label>
                            <input type="text" class="form-control" id="brand" required name="brand"
                                   v-model="newCar.brand">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Model</label>
                            <input type="text" class="form-control" id="model" required name="model"
                                   v-model="newCar.model">
                        </div>
                        <div class="form-check">

                        </div>
                        <button class="btn btn-primary" @click.prevent="createCar()">
                            Add Car
                        </button>
                    </div>


                </div>

                <br>
                <br>
                <nav class="navbar">
                    <span class="navbar-brand mb-0 h1">


                         Table</span>
                </nav>
                <div class="row">
                    <div class="col-12 ">
                        <table class="table" id="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Model</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="car in cars">
                                <th scope="row"> <div v-if="modalShow"> <img height="10" width="10" src="assets/load.gif"> </div>  <div v-else> @{{ car.id  }}</div></th>
                                <td>@{{car.brand}}</td>
                                <td>@{{car.model}}</td>

                                <td class="text-center">
                                    <a class="btn btn-info"  @click="setVal(car.id, car.brand, car.model)"
                                       class="btn btn-warning btn-lg" data-toggle="modal" data-target="#myModal">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd"
                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    <a @click="delVal(car)" data-toggle="modal" data-target="#modal2"
                                       class="btn btn-danger">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd"
                                                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </a>

                                </td>

                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>


            </div>


        </div>
        <div class="modal" id="modal2" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p> @{{mycar.brand}} @{{mycar.model}} will deleted immediately. Are you sure?</p>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="deleteCar(mycar)">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="myModal"class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit car</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" disabled class="form-control" id="e_id" name="id"
                               required :value="this.e_id">
                        Brand: <input type="text" class="form-control" id="e_brand" name="brand"
                                      required :value="this.e_brand">
                        Model: <input type="text" class="form-control" id="e_model" name="model"
                                      required :value="this.e_model">
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-primary" data-dismiss="modal" @click="editCar()" >
                            Save Changes
{{--                            @{{!modalShow ? "Please Wait" : "Save Changes" }}--}}
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>

<script type="text/javascript" src="/js/app.js"></script>
<script>


</script>
</body>
</html>
