
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Red Squadron Tasks<h2>
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('task')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">


                            <div class="col-sm-6">
                            <Table Border=1 style="width: 80%">
                            <colgroup>
                                <col span="1" style="width: 200px;">
                                <col span="1" style="width: 500px;">
                                <col span="1" style="width: 50px;">
                                <col span="1" style="width: 500px;">
                                <col span="1" style="width: 150px;">
                            </colgroup>
                            <tbody>
                            <TR><TH>Task Name<TH>Pilot ID<TH>Ship ID<TH>Description<TH>Task Status</TR>
                            <TR>
                                <TD><input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}"  style="width: 200px;">
                                <TD><input type="text" name="pilotid" id="PilotID" class="form-control" value="{{ old('task') }}" style="width: 50px;">
                                <TD><input type="text" name="shipid" id="ShipID" class="form-control" value="{{ old('task') }}" style="width: 50px;">
                                <TD><input type="text" name="description" id="Description" class="form-control" value="{{ old('task') }}"  style="width: 500px;">
                                <TD><select class="form-control" name="TaskStatus" id="TaskStatus" style="width: 150px;">
                                   <option value="New" SELECED>New</option>
                                   <option value="Assigned">Assigned</option>
                                   <option value="InProgres">InProgres</option>
                                   <option value="Waiting On Pilot">Waiting On Pilot</option>
                                   <option value="Waiting On Facility">Waiting On Facility</option>
                                   <option value="Waiting On Part">Waiting On Part</option>
                                   <option value="On Hold">On Hold</option>
                                   <option value="Complete">Complete</option>
                                </select>
                            </TR>
                            </tbody>
                            </Table>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Task</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Pilot</th>
                                <th>Ship</th>
                                <th>Ship Status</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>
                                        <td class="table-text"><div>{{ $task->status }}</div></td>
                                        <td class="table-text"><div>{{ $task->description }}</div></td>
                                        <td class="table-text"><div>{{ $task->pilotname }}</div></td>
                                        <td class="table-text"><div>{{ $task->shipname }}</div></td>
                                        <td class="table-text"><div>{{ $task->shipstatus }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{ url('task/'.$task->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

