.create-box{
  border: 1px solid #a9a9a9;
  border-radius: 15px;
  height: 400px;
  display: flex;
  justify-content: center;

}
.create-dl-content dt{
  width: 30%;
  margin: 13px 0;
}
.create-dl-content dd{
  width: 60%;
  margin: 13px 0;
}
.create-submit-content{
  display: flex;
  justify-content: end;
}
/* .create-dd-box{
  width: 90% !important;
  display: flex;
  justify-content: end;
}
.create-dd-box div{
  width: 60%;
} */
.create-dd-box{
  display: flex;
  flex-direction: column;
  margin: 10px;
}
.create-dd-content{
  margin: 20px 0 0 0;
}


/* <---- 枠ベース */
/* ----> 部品 */

.create-dl-content{
  margin: 20px 0;
}
.create-submit-content div{
  margin: 5px 30px 5px 0;
}
.create-dd-content input{
  width: 100px !important;
}
.bali-text{
  margin: 3px 0;
  font-size: 12px;
  color: red;
}
/* ---------------------------------------------- */


/* create部品とりあえず */
.create-form-toggle{
  display: none;
  /* visibility: collapse; */
}
.create-form-togglein{
  display: block;
  /* visibility: visible; */
}
.radio-button, .check-button{
  display: none;
}
.radio-text{
  padding: 10px 20px;
  background: lightgray;
  border-radius: 18px;
}
.radio-button:checked +label{
  background: skyblue;
}


.check-button:checked + label{
  background: skyblue;
}
.check-text{
  padding: 8px;
  background: lightgray;
  border-radius: 15px;
}

/* 一旦放置　あとでデザイン一括指定 */
input{
  /* border: none; */
  border: 1px solid #a9a9a9;
  border-radius: 3px;
  width: 200px;
  height: 30px;
  outline: none;
}
select{
  border: none;
  border-bottom: 1px solid #a9a9a9;
  width: 100px;
  outline: none;
}
/* ---------------------------------------------- */
