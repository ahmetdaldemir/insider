@extends('layout')
@section('content')
    @include('navigate')
    <div class="clearfix"></div>
    <div class="container" ng-controller="mainController">
        <div class="row">
            <div class="col-sm">
                <form action="javascript:;" ng-submit="addTeam()" method="post" id="teamForm">
                    <input name="model" type="hidden" id="model" value="Team" />
                    <div class="form-group">
                        <label for="teamName">Team</label>
                        <input type="text" name="name" class="form-control" id="teamName" required />
                        <small id="emailHelp" class="form-text text-muted">Exp Galatasaray</small>
                    </div>
                    <button type="submit" id="addTeamButton" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-sm">
                <label>Teams</label>
                <ul class="list-group" ng-init="getTeam()">
                    <li class="list-group-item" ng-repeat="item in teams">@{{item.name}}</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        var app = angular.module("app", []);
        app.controller("mainController", ['$scope', '$http', '$httpParamSerializerJQLike', '$filter', function ($scope, $http, $httpParamSerializerJQLike, $window, $filter) {
            $scope.addTeam = function () {
                $("#addTeamButton").addClass('disabled');

                const data = $("#teamForm").serialize();
                $http({
                    method: 'POST',
                    url: "/crud",
                    data: data,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    $scope.getTeam();
                    $("#teamName").val('');
                    $("#addTeamButton").removeClass('disabled');
                });
            }
            $scope.getTeam = function () {
                $http({
                    method: 'GET',
                    url: "/allteam",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    $scope.teams = response.data;
                });
            }
        }]);

    </script>

@endsection
