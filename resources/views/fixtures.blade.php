@extends('layout')
@section('content')
    @include('navigate')
    <div class="clearfix"></div>
    <div class="container" ng-controller="mainController">
        <div class="row">
            <div class="col-sm">
                <button type="button" class="btn btn-primary" ng-click="createFixture()">Create Fixture</button>
            </div>
            <div class="col-sm">
                <table class="table" ng-init="getFixture()">
                    <thead>
                    <tr>
                        <th scope="col">Team</th>
                        <th scope="col">Played</th>
                        <th scope="col">W</th>
                        <th scope="col">D</th>
                        <th scope="col">L</th>
                        <th scope="col">P</th>
                        <th scope="col">DG</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="item in fixturelist">
                        <th scope="col">@{{ item.team }}</th>
                        <th scope="col">@{{ item.played }}</th>
                        <th scope="col">@{{ item.won }}</th>
                        <th scope="col">@{{ item.drawn }}</th>
                        <th scope="col">@{{ item.lost }}</th>
                        <th scope="col">@{{ item.point }}</th>
                        <th scope="col">@{{ item.dg }}</th>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        var app = angular.module("app", []);
        app.controller("mainController", ['$scope', '$http', '$httpParamSerializerJQLike', '$filter', function ($scope, $http, $httpParamSerializerJQLike, $window, $filter) {
            $scope.createFixture = function () {
                $http({
                    method: 'POST',
                    url: "/createfixture",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    $scope.getFixture();
                });
            }
            $scope.getFixture = function () {
                $http({
                    method: 'GET',
                    url: "/allMatches",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    console.log(response.data);
                    $scope.fixturelist = response.data;
                });
            }
        }]);

    </script>

@endsection
