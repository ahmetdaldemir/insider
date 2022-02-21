@extends('layout')
@section('content')
    @include('navigate')
    <div class="clearfix"></div>
    <div class="container" ng-controller="mainController">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary" ng-click="createSimulate()">Similate</button>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row" ng-init="getWeekMatch()">
            <table style="    margin-right: 20px;" class="table col" ng-repeat="item in matchs">
                <thead>
                <tr>
                    <th scope="col" colspan="3">@{{ item.name }}</th>
                </tr>
                </thead>
                <thead>
                   <tr>
                       <th scope="col">Takım 1</th>
                       <th scope="col">-</th>
                       <th scope="col">Takım 2</th>
                   </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="team in item.team">
                        <td>@{{ team.homeowner_name }}</td>
                        <td>-</td>
                        <td>@{{ team.guestowner_name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var app = angular.module("app", []);
        app.controller("mainController", ['$scope', '$http', '$httpParamSerializerJQLike', '$filter', function ($scope, $http, $httpParamSerializerJQLike, $window, $filter) {

            $scope.getWeekMatch = function () {
                $http({
                    method: 'GET',
                    url: "/getWeekMatch",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    $scope.matchs = response.data;
                });
            }


            $scope.createSimulate = function () {
                $http({
                    method: 'GET',
                    url: "/createSimulate",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    $scope.getWeekMatch();
                });
            }
        }]);

    </script>

@endsection
