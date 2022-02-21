@extends('layout')
@section('content')
    @include('navigate')
    <div class="clearfix"></div>
    <div class="container" ng-controller="mainController">
        <div class="row">
            <div class="col-sm">
                <form action="javascript:;" ng-submit="addWeek()" method="post" id="weekForm">
                    <input name="model" type="hidden" id="model" value="Week" />
                    <div class="form-group">
                        <label for="weekName">Hafta</label>
                        <input type="text" name="week" class="form-control" id="weekName" required />
                        <small id="emailHelp" class="form-text text-muted">Exp 1. Week</small>
                    </div>
                    <button type="submit" id="addWeekButton" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-sm">
                <label>Haftalar</label>
                <ul class="list-group" ng-init="getWeek()">
                    <li class="list-group-item" ng-repeat="item in weeks">@{{item.week}}</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        var app = angular.module("app", []);
        app.controller("mainController", ['$scope', '$http', '$httpParamSerializerJQLike', '$filter', function ($scope, $http, $httpParamSerializerJQLike, $window, $filter) {
            $scope.addWeek = function () {
                $("#addWeekButton").addClass('disabled');

                const data = $("#weekForm").serialize();
                $http({
                    method: 'POST',
                    url: "/crud",
                    data: data,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    $scope.getWeek();
                    $("#weekName").val('');
                    $("#addWeekButton").removeClass('disabled');
                });
            }
            $scope.getWeek = function () {
                $http({
                    method: 'GET',
                    url: "/allweek",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    $scope.weeks = response.data;
                });
            }
        }]);

    </script>

@endsection
