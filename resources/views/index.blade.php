<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale-1.0"/>
    <title>Canvas Generator</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/estilo.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ secure_asset('css/AdminLTE.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script type="text/javascript" src="{{asset('js/bootstrap/jquery-3.4.0.min.js.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap/bootstrap.min.js')}}"></script>
</head>
<body style="background-color: #F8F9FA" >
    <nav class="navbar navbar-light bg-light" id="cabecalho">
        <a class="navbar-brand" href="#">
          <img src="{{asset('images/logo.jpg')}}" width="60" height="60" class="d-inline-block align-top" alt="">
          Unified Game Canvas (UGD) Generator
        </a>
    </nav>
    <div>
        <form role="form" enctype="multipart/form-data" method="POST" action="{{route('readJsonFile')}}">
            @csrf
            <div id="button" style="width: 99%" class="text-right">
                <input id='browse' name="jsonFile" type='file' style='width:0px' onchange="this.form.submit();">
                <button id='browser' type="button" class="btn btn-outline-success" onclick="browse.click()" >
                    Load Json File
                </button>
            </div>
        </form>
        <form role="form"  method="POST" action="{{route('generateFiles')}}">
            @csrf
            <div id="table" style="background-color: #FFFFFF">
                <table id="canvas">
                    <tr style="border: none;">
                        <td colspan="9"><p>Game Impact</p></td>
                    </tr>
                    <tr>
                        <td colspan="9" style="text-align: center;">
                            <label style="width: 100%">
                                @if(isset($data))
                                    <textarea rows="2" placeholder="Emotion, Fun, Enjoyment, Learning, Behavioral Changes, Sociability, Metrics" name="impact" style="resize: none;"> {{$data["impact"]}}</textarea>
                                @else
                                    <textarea rows="2" placeholder="Emotion, Fun, Enjoyment, Learning, Behavioral Changes, Sociability, Metrics" name="impact" style="resize: none;"></textarea>
                                @endif
                            </label>
                        </td>
                    </tr>
                </table>
                <table id="canvas" class=>
                    <tr>
                        <td id="info">
                            <p>Game Concept</p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="concept1" cols="25" rows="1" style="resize: none;" placeholder="Name, Title, Version">{{$data["concept1"]}}</textarea>
                                    @else
                                        <textarea name="concept1" cols="25" rows="1" style="resize: none;" placeholder="Name, Title, Version"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="concept2" cols="25" rows="2" style="resize: none;" placeholder="Objective, Intention, Idea">{{$data["concept2"]}}</textarea>
                                    @else
                                        <textarea name="concept2" cols="25" rows="2" style="resize: none;" placeholder="Objective, Intention, Idea"></textarea>
                                    @endif

                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="concept3" cols="25" rows="2" style="resize: none;" placeholder="Theme, story, inspiration">{{$data["concept3"]}}</textarea>
                                    @else
                                        <textarea name="concept3" cols="25" rows="2" style="resize: none;" placeholder="Theme, story, inspiration"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="concept4" cols="25" rows="1" style="resize: none;" placeholder="Genre, type">{{$data["concept4"]}}</textarea>
                                    @else
                                        <textarea name="concept4" cols="25" rows="1" style="resize: none;" placeholder="Genre, type"></textarea>
                                    @endif
                                </label></p>
                            <div class="triangle-right"></div>
                            <p style="border-top: 1px solid black;">Game Player</p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="player1" cols="25" rows="1" style="resize: none;" placeholder="Age">{{$data["player1"]}}</textarea>
                                    @else
                                        <textarea name="player1" cols="25" rows="1" style="resize: none;" placeholder="Age"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="player2" cols="25" rows="1" style="resize: none;" placeholder="Type, Segment">{{$data["player2"]}}</textarea>
                                    @else
                                        <textarea name="player2" cols="25" rows="1" style="resize: none;" placeholder="Type, Segment"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="player3" cols="25" rows="1" style="resize: none;" placeholder="Number of Players">{{$data["player3"]}}</textarea>
                                    @else
                                        <textarea name="player3" cols="25" rows="1" style="resize: none;" placeholder="Number of Players"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="player4" cols="25" rows="1" style="resize: none;" placeholder="Community">{{$data["player4"]}}</textarea>
                                    @else
                                        <textarea name="player4" cols="25" rows="1" style="resize: none;" placeholder="Community"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="player5" cols="25" rows="1" style="resize: none;" placeholder="Character">{{$data["player5"]}}</textarea>
                                    @else
                                        <textarea name="player5" cols="25" rows="1" style="resize: none;" placeholder="Character"></textarea>
                                    @endif
                                </label></p>
                        </td>

                        <td id="space">
                            <div class="triangle-right"></div>
                        </td>

                        <td id="info">
                            <p>Game Play</p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="play1" cols="25" rows="2" style="resize: none;" placeholder="Start, Intention-Flow, End, Win Condition">{{$data["play1"]}}</textarea>
                                    @else
                                        <textarea name="play1" cols="25" rows="2" style="resize: none;" placeholder="Start, Intention-Flow, End, Win Condition"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="play2" cols="25" rows="2" style="resize: none;" placeholder="Rules, Options, Powers, Behaviors">{{$data["play2"]}}</textarea>
                                    @else
                                        <textarea name="play2" cols="25" rows="2" style="resize: none;" placeholder="Rules, Options, Powers, Behaviors"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="play3" cols="25" rows="2" style="resize: none;" placeholder="Goals, Mission, Challenges, Enemy & Boss">{{$data["play3"]}}</textarea>
                                    @else
                                        <textarea name="play3" cols="25" rows="2" style="resize: none;" placeholder="Goals, Mission, Challenges, Enemy & Boss"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="play4" cols="25" rows="2" style="resize: none;" placeholder="Boundaries, Space, Level Design, World">{{$data["play4"]}}</textarea>
                                    @else
                                        <textarea name="play4" cols="25" rows="2" style="resize: none;" placeholder="Boundaries, Space, Level Design, World"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="play5" cols="25" rows="2" style="resize: none;" placeholder="Resources, Objects, Scene, Window">{{$data["play5"]}}</textarea>
                                    @else
                                        <textarea name="play5" cols="25" rows="2" style="resize: none;" placeholder="Resources, Objects, Scene, Window"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="play6" cols="25" rows="2" style="resize: none;" placeholder="Components, Play Elements">{{$data["play6"]}}</textarea>
                                    @else
                                        <textarea name="play6" cols="25" rows="2" style="resize: none;" placeholder="Components, Play Elements"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="play7" cols="25" rows="2" style="resize: none;" placeholder="Punishment, Failure">{{$data["play7"]}}</textarea>
                                    @else
                                        <textarea name="play7" cols="25" rows="2" style="resize: none;" placeholder="Punishment, Failure"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="play8" cols="25" rows="1" style="resize: none;" placeholder="Reward, Improvement">{{$data["play8"]}}</textarea>
                                    @else
                                        <textarea name="play8" cols="25" rows="1" style="resize: none;" placeholder="Reward, Improvement"></textarea>
                                    @endif
                                </label></p>
                        </td>

                        <td id="space">
                            <div class="triangle-right"></div>
                        </td>

                        <td id="info">
                            <p>Game Flow</p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="flow1" cols="25" rows="2" style="resize: none;" placeholder="Loops, Turns">{{$data["flow1"]}}</textarea>
                                    @else
                                        <textarea name="flow1" cols="25" rows="2" style="resize: none;" placeholder="Loops, Turns"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="flow2" cols="25" rows="2" style="resize: none;" placeholder="Time, Ramdomness, AI">{{$data["flow2"]}}</textarea>
                                    @else
                                        <textarea name="flow2" cols="25" rows="2" style="resize: none;" placeholder="Time, Ramdomness, AI"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="flow3" cols="25" rows="2" style="resize: none;" placeholder="Choices, Decisions, Uncertainty, Anticipation,Experience">{{$data["flow3"]}}</textarea>
                                    @else
                                        <textarea name="flow3" cols="25" rows="2" style="resize: none;" placeholder="Choices, Decisions, Uncertainty, Anticipation,Experience"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="flow4" cols="25" rows="3" style="resize: none;" placeholder="Skill Challenges, Incentive, Longevity">{{$data["flow4"]}}</textarea>
                                    @else
                                        <textarea name="flow4" cols="25" rows="3" style="resize: none;" placeholder="Skill Challenges, Incentive, Longevity"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    <textarea disabled cols="25" rows="10" style="resize: none;background-color: white"></textarea>
                                </label></p>
                        </td>

                        <td id="space">
                            <div class="triangle-right"></div>
                        </td>

                        <td id="info">
                            <p>Game Core</p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="core1" cols="25" rows="2" style="resize: none;" placeholder="Actions, Mechanics">{{$data["core1"]}}</textarea>
                                    @else
                                        <textarea name="core1" cols="25" rows="2" style="resize: none;" placeholder="Actions, Mechanics"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="core2" cols="25" rows="2" style="resize: none;" placeholder="Eﬀects, Dynamics">{{$data["core2"]}}</textarea>
                                    @else
                                        <textarea name="core2" cols="25" rows="2" style="resize: none;" placeholder="Eﬀects, Dynamics"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="core3" cols="25" rows="2" style="resize: none;" placeholder="Elements, Cut Scenes,Aesthetic Layout">{{$data["core3"]}}</textarea>
                                    @else
                                        <textarea name="core3" cols="25" rows="2" style="resize: none;" placeholder="Elements, Cut Scenes,Aesthetic Layout"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    <textarea disabled cols="25" rows="14" style="resize: none;background-color: white"></textarea>
                                </label></p>
                        </td>

                        <td id="space">
                            <div class="triangle-right"></div>
                        </td>

                        <td id="info">
                            <p>Game Interaction</p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="interaction1" cols="25" rows="2" style="resize: none;" placeholder="Platform, Accessibility, Operational Systems, Technology, Frameworks">{{$data["interaction1"]}}</textarea>
                                    @else
                                        <textarea name="interaction1" cols="25" rows="2" style="resize: none;" placeholder="Platform, Accessibility, Operational Systems, Technology, Frameworks"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="interaction2" cols="25" rows="2" style="resize: none;" placeholder="Controls, I/O Devices">{{$data["interaction2"]}}</textarea>
                                    @else
                                        <textarea name="interaction2" cols="25" rows="2" style="resize: none;" placeholder="Controls, I/O Devices"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="interaction3" cols="25" rows="2" style="resize: none;" placeholder="Settings, Single or Multiplayer">{{$data["interaction3"]}}</textarea>
                                    @else
                                        <textarea name="interaction3" cols="25" rows="2" style="resize: none;" placeholder="Settings, Single or Multiplayer"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="interaction4" cols="25" rows="2" style="resize: none;" placeholder="Cameras, Menus, UI">{{$data["interaction4"]}}</textarea>
                                    @else
                                        <textarea name="interaction4" cols="25" rows="2" style="resize: none;" placeholder="Cameras, Menus, UI"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    @if(isset($data))
                                        <textarea name="interaction5" cols="25" rows="2" style="resize: none;" placeholder="Feedback, Scoring">{{$data["interaction5"]}}</textarea>
                                    @else
                                        <textarea name="interaction5" cols="25" rows="2" style="resize: none;" placeholder="Feedback, Scoring"></textarea>
                                    @endif
                                </label></p>
                            <p><label style="width: 98%;">
                                    <textarea disabled cols="25" rows="8" style="resize: none;background-color: white"></textarea>
                                </label></p>
                        </td>

                        <td id="space">
                            <div class="triangle-right"></div>
                        </td>
                    </tr>

                </table>
                <table id="canvas">
                    <tr>
                        <td colspan="9">
                            <p>Game Business</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" style="text-align:center;">
                            <label style="width: 98%;">
                                @if(isset($data))
                                    <textarea name="business" cols="100" rows="2" style="resize: none;" placeholder="Minimun Viable Prototipe, Costs, Revenues, ROI, Channels, Positioning, Bonus Materia">{{$data["business"]}}</textarea>
                                @else
                                    <textarea name="business" cols="100" rows="2" style="resize: none;" placeholder="Minimun Viable Prototipe, Costs, Revenues, ROI, Channels, Positioning, Bonus Materia"></textarea>
                                @endif
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <label style="width: 100%;">
                    @if(isset($data))
                        <textarea id="email" name="email" style="resize: none;" placeholder="Type your email for receive the files.">{{$data["email"]}}</textarea>
                    @else
                        <textarea id="email" name="email" style="resize: none;" placeholder="Type your email for recieve the files."></textarea>
                    @endif
                </label>
            </div>
            <div id="button">  
                <button type="submit" class="btn btn-outline-success">Success</button>
            </div>
        </form>
    </div>

    <div class="card-footer text-muted">
        work in progress
    </div>

</body>
</html>
