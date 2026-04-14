<!DOCTYPE html>
<html>
  <head>

    <link rel="stylesheet" href="../assets/cursedStyle.css">
    <style>
      .submit{
        background-color:white;
        border:1px solid gray;
        border-radius: 5px;
        padding: 5px;
        position: absolute;
        top: 640px;
        left: calc(50% - 250px);
      }
      .submit:hover{
        background-color:gray;
        cursor:pointer;
      }
      .text{
        width:500px;
        margin:auto;
        position: absolute;
        top: 100px;
        left: 50%;
        transform:translate(-50%, 0);
        transition: top 8s;
      }
      #submit:checked + .text{
        top: 1500px;
      }
      #submit:checked ~ .shredder{
        display:block;
      }
      #submit{
        opacity: 0;
      }
      .shredder{
        display:none;
        position: absolute;
        top: 1000px;
        left: 0%;
        width:1300px;
        height: 1000px;
        div{
          position: absolute;
          top: 0px;
          width: 100%;
          height: 100%;
          background-size: 100% 1000px;
          background-image: url("./contact/shredder.webp");
        }
        :nth-child(1){
          z-index: 100;
          background-position: 0 calc(-21.5 * 10px);
          top: calc(21.5 * 10px);
          height: 79.5%;
        }
        :nth-child(2){
          height: 21.5%;
          z-index: -100;
        }
      }
      .title{
        margin-bottom:2000px;
      }
    </style>
  </head>
  <body id="grad1">
    <h1 class="title"> Contact </h1>
    <input id="submit" type="radio">
    <textarea class="text" rows="40" cols="80"></textarea>
    <label for="submit" class="submit">Submit</label>
    <div class="shredder">
      <div></div>
      <div></div>
    </div>
  </body>
</html>
