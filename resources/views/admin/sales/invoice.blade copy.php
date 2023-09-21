<!DOCTYPE html>
<html class="no-js" lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1">  -->
    <title> Invoice</title>
<style>

    .llos {
     max-width: 202px !important;
}
.text-dark{
  color: #000 !important;
}
:root {
  --theme-color: #1cb9c8;
  --title-color: #010f1c;
  --body-color: #535b61;
  --smoke-color: #f2f2f2;
  --smoke-dark: #dde2ee;
  --black-color: #000000;
  --white-color: #ffffff;
  --light-color: #72849b;
  --border-color: #cfd3dc;
  --title-font: "Inter", sans-serif;
  --body-font: "Inter", sans-serif;
  --main-container: 1380px;
  --container-gutters: 24px;
  --section-space: 50px;
  --section-title-space: 70px;
  --ripple-ani-duration: 5s;
}
@use "sass:math";
html,
body {
  scroll-behavior: auto !important;
}
body {
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-weight: 400;
  color: var(--body-color);
  line-height: 22px;
  overflow-x: hidden;
  -webkit-font-smoothing: antialiased;
}
iframe {
  border: none;
  width: 100%;
}
.slick-slide:focus,
button:focus,
a:focus,
a:active,
input,
input:hover,
input:focus,
input:active,
textarea,
textarea:hover,
textarea:focus,
textarea:active {
  outline: none;
}
input:focus {
  outline: none;
  box-shadow: none;
}
img:not([draggable]),
embed,
object,
video {
  max-width: 100%;
  height: auto;
}
ul {
  list-style-type: disc;
}
ol {
  list-style-type: decimal;
}
table {
  margin: 0 0 1.5em;
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0px;
    border: 1px solid var(--border-color) !important;
}
th {
  font-weight: 700;
  color: var(--title-color);
}
td,
th {
 border: 1px solid #bfbfbf !important;
    padding: 2px 4px !important;
}
a {
  color: var(--theme-color);
  text-decoration: none;
  outline: 0;
  -webkit-transition: all ease 0.4s;
  transition: all ease 0.4s;
}
a:hover {
  color: var(--title-color);
}
a:active,
a:focus,
a:hover,
a:visited {
  text-decoration: none;
  outline: 0;
}
button {
  -webkit-transition: all ease 0.4s;
  transition: all ease 0.4s;
}
img {
  border: none;
  max-width: 100%;
}
ins {
  text-decoration: none;
}
pre {
  font-family: var(--body-font);
  background: #f5f5f5;
  color: #666;
  font-size: 14px;
  margin: 20px 0;
  overflow: auto;
  padding: 20px;
  white-space: pre-wrap;
  word-wrap: break-word;
}
span.ajax-loader:empty,
p:empty {
  display: none;
}
p {
  font-family: var(--body-font);
  margin: 0 0 18px 0;
  color: var(--body-color);
  line-height: 1.571;
}
h1 a,
h2 a,
h3 a,
h4 a,
h5 a,
h6 a,
p a,
span a {
  font-size: inherit;
  font-family: inherit;
  font-weight: inherit;
  line-height: inherit;
}
.h1,
h1,
.h2,
h2,
.h3,
h3,
.h4,
h4,
.h5,
h5,
.h6,
h6 {
  font-family: var(--title-font);
  color: var(--title-color);
  text-transform: none;
  font-weight: 700;
  line-height: 1.4;
  margin: 0 0 15px 0;
}
.h1,
h1 {
  font-size: 60px;
  line-height: 1.167;
}
.h2,
h2 {
  font-size: 48px;
  line-height: 1.208;
}
.h3,
h3 {
  font-size: 36px;
  line-height: 1.278;
}
.h4,
h4 {
  font-size: 30px;
  line-height: 1.333;
  font-weight: 600;
}
.h5,
h5 {
  font-size: 24px;
  line-height: 1.417;
  font-weight: 600;
}
.h6,
h6 {
  font-size: 20px;
  line-height: 1.5;
  font-weight: 600;
}
@media (max-width: 1399px) {
  .h1,
  h1 {
    font-size: 48px;
  }
  .h2,
  h2 {
    font-size: 40px;
  }
}
@media (max-width: 1199px) {
  .h1,
  h1 {
    font-size: 40px;
  }
  .h2,
  h2 {
    font-size: 36px;
  }
  .h3,
  h3 {
    font-size: 30px;
  }
  .h4,
  h4 {
    font-size: 24px;
  }
  .h5,
  h5 {
    font-size: 20px;
  }
  .h6,
  h6 {
    font-size: 16px;
  }
}
@media (max-width: 767px) {
  .h1,
  h1 {
    font-size: 40px;
  }
  .h2,
  h2 {
    font-size: 28px;
  }
  .h3,
  h3 {
    font-size: 26px;
  }
  .h4,
  h4 {
    font-size: 22px;
  }
  .h5,
  h5 {
    font-size: 18px;
  }
  .h6,
  h6 {
    font-size: 16px;
  }
}
@media (max-width: 575px) {
  .h1,
  h1 {
    font-size: 34px;
    line-height: 1.3;
  }
}
@media (max-width: 375px) {
  .h1,
  h1 {
    font-size: 32px;
  }
}
@media (max-width: 1399px) {
  :root {
    --main-container: 850px;
  }
}
.invoice-container {
      width: 874px;
    padding: 10px 4px;
    margin: 15px auto;
    position: relative;
    z-index: 5;
}
.invoice-container-wrap {
  overflow: auto;
}
.slick-track > [class*="col"] {
  -webkit-flex-shrink: 0;
  -ms-flex-negative: 0;
  flex-shrink: 0;
  width: 100%;
  max-width: 100%;
  padding-right: calc(var(--bs-gutter-x) / 2);
  padding-left: calc(var(--bs-gutter-x) / 2);
  margin-top: var(--bs-gutter-y);
}
.gy-30 {
  --bs-gutter-y: 30px;
}
.gy-40 {
  --bs-gutter-y: 40px;
}
.gy-50 {
  --bs-gutter-y: 50px;
}
.gx-10 {
  --bs-gutter-x: 10px;
}
@media (min-width: 1500px) {
  .gx-60 {
    --bs-gutter-x: 60px;
  }
}
@media (min-width: 1399px) {
  .gx-30 {
    --bs-gutter-x: 30px;
  }
  .gx-25 {
    --bs-gutter-x: 25px;
  }
  .gx-40 {
    --bs-gutter-x: 40px;
  }
}
@media (max-width: 991px) {
  .gy-50 {
    --bs-gutter-y: 40px;
  }
}
.px-5 {
  padding-right: 5px;
  padding-left: 5px;
}
.px-10 {
  padding-right: 10px;
  padding-left: 10px;
}
.px-15 {
  padding-right: 15px;
  padding-left: 15px;
}
.px-20 {
  padding-right: 20px;
  padding-left: 20px;
}
.px-25 {
  padding-right: 25px;
  padding-left: 25px;
}
.px-30 {
  padding-right: 30px;
  padding-left: 30px;
}
.px-35 {
  padding-right: 35px;
  padding-left: 35px;
}
.px-40 {
  padding-right: 40px;
  padding-left: 40px;
}
.px-45 {
  padding-right: 45px;
  padding-left: 45px;
}
.px-50 {
  padding-right: 50px;
  padding-left: 50px;
}
.py-5 {
  padding-top: 5px;
  padding-bottom: 5px;
}
.py-10 {
  padding-top: 10px;
  padding-bottom: 10px;
}
.py-15 {
  padding-top: 15px;
  padding-bottom: 15px;
}
.py-20 {
  padding-top: 20px;
  padding-bottom: 20px;
}
.py-25 {
  padding-top: 25px;
  padding-bottom: 25px;
}
.py-30 {
  padding-top: 30px;
  padding-bottom: 30px;
}
.py-35 {
  padding-top: 35px;
  padding-bottom: 35px;
}
.py-40 {
  padding-top: 40px;
  padding-bottom: 40px;
}
.py-45 {
  padding-top: 45px;
  padding-bottom: 45px;
}
.py-50 {
  padding-top: 50px;
  padding-bottom: 50px;
}
.pt-5 {
  padding-top: 5px;
}
.pt-10 {
  padding-top: 10px;
}
.pt-15 {
  padding-top: 15px;
}
.pt-20 {
  padding-top: 20px;
}
.pt-25 {
  padding-top: 25px;
}
.pt-30 {
  padding-top: 30px;
}
.pt-35 {
  padding-top: 35px;
}
.pt-40 {
  padding-top: 40px;
}
.pt-45 {
  padding-top: 45px;
}
.pt-50 {
  padding-top: 50px;
}
.pb-5 {
  padding-bottom: 5px;
}
.pb-10 {
  padding-bottom: 10px;
}
.pb-15 {
  padding-bottom: 15px;
}
.pb-20 {
  padding-bottom: 20px;
}
.pb-25 {
  padding-bottom: 25px;
}
.pb-30 {
  padding-bottom: 30px;
}
.pb-35 {
  padding-bottom: 35px;
}
.pb-40 {
  padding-bottom: 40px;
}
.pb-45 {
  padding-bottom: 45px;
}
.pb-50 {
  padding-bottom: 50px;
}
.pl-5 {
  padding-left: 5px;
}
.pl-10 {
  padding-left: 10px;
}
.pl-15 {
  padding-left: 15px;
}
.pl-20 {
  padding-left: 20px;
}
.pl-25 {
  padding-left: 25px;
}
.pl-30 {
  padding-left: 30px;
}
.pl-35 {
  padding-left: 35px;
}
.pl-40 {
  padding-left: 40px;
}
.pl-45 {
  padding-left: 45px;
}
.pl-50 {
  padding-left: 50px;
}
.pr-5 {
  padding-right: 5px;
}
.pr-10 {
  padding-right: 10px;
}
.pr-15 {
  padding-right: 15px;
}
.pr-20 {
  padding-right: 20px;
}
.pr-25 {
  padding-right: 25px;
}
.pr-30 {
  padding-right: 30px;
}
.pr-35 {
  padding-right: 35px;
}
.pr-40 {
  padding-right: 40px;
}
.pr-45 {
  padding-right: 45px;
}
.pr-50 {
  padding-right: 50px;
}
.mx-5 {
  margin-right: 5px;
  margin-left: 5px;
}
.mx-10 {
  margin-right: 10px;
  margin-left: 10px;
}
.mx-15 {
  margin-right: 15px;
  margin-left: 15px;
}
.mx-20 {
  margin-right: 20px;
  margin-left: 20px;
}
.mx-25 {
  margin-right: 25px;
  margin-left: 25px;
}
.mx-30 {
  margin-right: 30px;
  margin-left: 30px;
}
.mx-35 {
  margin-right: 35px;
  margin-left: 35px;
}
.mx-40 {
  margin-right: 40px;
  margin-left: 40px;
}
.mx-45 {
  margin-right: 45px;
  margin-left: 45px;
}
.mx-50 {
  margin-right: 50px;
  margin-left: 50px;
}
.my-5 {
  margin-top: 5px;
  margin-bottom: 5px;
}
.my-10 {
  margin-top: 10px;
  margin-bottom: 10px;
}
.my-15 {
  margin-top: 15px;
  margin-bottom: 15px;
}
.my-20 {
  margin-top: 20px;
  margin-bottom: 20px;
}
.my-25 {
  margin-top: 25px;
  margin-bottom: 25px;
}
.my-30 {
  margin-top: 30px;
  margin-bottom: 30px;
}
.my-35 {
  margin-top: 35px;
  margin-bottom: 35px;
}
.my-40 {
  margin-top: 40px;
  margin-bottom: 40px;
}
.my-45 {
  margin-top: 45px;
  margin-bottom: 45px;
}
.my-50 {
  margin-top: 50px;
  margin-bottom: 50px;
}
.mt-5 {
  margin-top: 5px;
}
.mt-10 {
  margin-top: 10px;
}
.mt-15 {
  margin-top: 15px;
}
.mt-20 {
  margin-top: 20px;
}
.mt-25 {
  margin-top: 25px;
}
.mt-30 {
  margin-top: 30px;
}
.mt-35 {
  margin-top: 35px;
}
.mt-40 {
  margin-top: 40px;
}
.mt-45 {
  margin-top: 45px;
}
.mt-50 {
  margin-top: 50px;
}
.mb-5 {
  margin-bottom: 5px;
}
.mb-10 {
  margin-bottom: 10px;
}
.mb-15 {
  margin-bottom: 15px;
}
.mb-20 {
  margin-bottom: 20px;
}
.mb-25 {
  margin-bottom: 25px;
}
.mb-30 {
  margin-bottom: 30px;
}
.mb-35 {
  margin-bottom: 35px;
}
.mb-40 {
  margin-bottom: 40px;
}
.mb-45 {
  margin-bottom: 45px;
}
.mb-50 {
  margin-bottom: 50px;
}
.ml-5 {
  margin-left: 5px;
}
.ml-10 {
  margin-left: 10px;
}
.ml-15 {
  margin-left: 15px;
}
.ml-20 {
  margin-left: 20px;
}
.ml-25 {
  margin-left: 25px;
}
.ml-30 {
  margin-left: 30px;
}
.ml-35 {
  margin-left: 35px;
}
.ml-40 {
  margin-left: 40px;
}
.ml-45 {
  margin-left: 45px;
}
.ml-50 {
  margin-left: 50px;
}
.mr-5 {
  margin-right: 5px;
}
.mr-10 {
  margin-right: 10px;
}
.mr-15 {
  margin-right: 15px;
}
.mr-20 {
  margin-right: 20px;
}
.mr-25 {
  margin-right: 25px;
}
.mr-30 {
  margin-right: 30px;
}
.mr-35 {
  margin-right: 35px;
}
.mr-40 {
  margin-right: 40px;
}
.mr-45 {
  margin-right: 45px;
}
.mr-50 {
  margin-right: 50px;
}
.mb-60 {
  margin-bottom: 60px;
}
.mt-n1 {
  margin-top: -0.25rem;
}
.mt-n2 {
  margin-top: -0.6rem;
}
.mt-n3 {
  margin-top: -1rem;
}
.mt-n4 {
  margin-top: -1.5rem;
}
.mt-n5 {
  margin-top: -3rem;
}
.mb-n1 {
  margin-bottom: -0.25rem;
}
.mb-n2 {
  margin-bottom: -0.6rem;
}
.mb-n3 {
  margin-bottom: -1rem;
}
.mb-n4 {
  margin-bottom: -1.5rem;
}
.mb-n5 {
  margin-bottom: -3rem;
}
.space,
.space-top {
  padding-top: var(--section-space);
}
.space,
.space-bottom {
  padding-bottom: var(--section-space);
}
.as-invoice {
  position: relative;
  z-index: 4;
  background-color: var(--white-color);
}
.as-invoice .download-inner {
  padding: 50px;
}
.as-invoice b {
  color: var(--title-color);
}
.as-invoice .big-title {
  font-size: 44px;
  margin-bottom: 0;
  text-align: right;
}
.as-invoice .header-bottom {
  margin-top: 22px;
  margin-bottom: 19px;
}
.as-invoice address {
  margin-bottom: 0;
}
.invoice-right {
  text-align: right;
}
.invoice-table {
  border: none;
  margin-bottom: 25px;
}
.invoice-table th {
  color: var(--title-color);
}
.invoice-table th,
.invoice-table td {
  padding: 6px 7px;
    border: none;
}
.invoice-table th:last-child,
.invoice-table td:last-child {
  text-align: right;
}
.invoice-table tr {
  border-bottom: 1px solid var(--border-color);
  position: relative;
}
.invoice-table thead th,
.invoice-table thead td {
      background-color: #0b1474d9;
}
.invoice-table thead th:first-child,
.invoice-table thead td:first-child {
  /*border-radius: 99px 0 0 99px;*/
}
.invoice-table thead th:last-child,
.invoice-table thead td:last-child {
  /*border-radius: 0 99px 99px 0;*/
}
.invoice-table thead tr {
  border-bottom: none;
}
.table-stripe thead th,
.table-stripe thead td {
  background-color: var(--smoke-dark);
}
.table-stripe tr {
  border-bottom: none;
}
.table-stripe tr:nth-child(2n) th,
.table-stripe tr:nth-child(2n) td {
  background-color: var(--smoke-color);
}
.table-stripe tr:nth-child(2n) th:first-child,
.table-stripe tr:nth-child(2n) td:first-child {
  border-radius: 99px 0 0 99px;
}
.table-stripe tr:nth-child(2n) th:last-child,
.table-stripe tr:nth-child(2n) td:last-child {
  border-radius: 0 99px 99px 0;
}
.total-table {
  border: none;
  margin-bottom: 0;
  margin-top: -4px;
}
.total-table th,
.total-table td {
  border: none;
  padding: 4px 20px;
}
.total-table th:nth-child(2),
.total-table td:nth-child(2) {
  text-align: right;
}
.total-table tr:last-child {
  border-top: 1px solid var(--border-color);
}
.total-table tr:last-child th,
.total-table tr:last-child td {
  padding: 15px 20px;
}
.total-table tr:nth-last-child(2) th,
.total-table tr:nth-last-child(2) td {
  padding: 4px 20px 16px 20px;
}
hr.style1 {
  margin-top: 24px;
  margin-bottom: 24px;
  background-color: var(--border-color);
  opacity: 1;
}
.table-title {
  font-size: 16px;
  margin-bottom: 7px;
}
.text-title {
  color: var(--title-color);
  font-weight: 500;
}
.invoice-note {
  border-top: 1px solid var(--border-color);
  border-bottom: 1px solid var(--border-color);
  padding-top: 15px;
  padding-bottom: 15px;
  text-align: center;
}
.invoice-note svg {
  margin-right: 5px;
  margin-top: -3px;
}
.invoice-note b {
  margin-right: 5px;
}
.body-shape1 {
  height: 5px;
  width: 100%;
  background-color: var(--smoke-dark);
  position: absolute;
  bottom: 0;
  left: 0;
}
.body-shape1:before {
  content: "";
  height: 16px;
  width: 50%;
  position: absolute;
  bottom: 0;
  right: 0;
  background-color: var(--smoke-dark);
  border-radius: 99px 0 0 0;
}
.body-shape2 {
  position: absolute;
  bottom: 65px;
  right: 0;
}
.body-shape2 .shape {
  height: 20px;
  width: 35px;
  background-color: var(--smoke-color);
  border-radius: 99px 0 0 99px;
  margin-bottom: 10px;
}
.body-shape3 {
  position: absolute;
  top: 0;
  left: 0;
  z-index: -1;
}
.body-shape3 svg {
  max-width: 100%;
}
.invoice-buttons {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
  -ms-flex-pack: center;
  justify-content: center;
  border-radius: 999px;
  overflow: hidden;
  margin-top: 12px;
  position: relative;
  top: -50px;
}
.invoice-buttons a,
.invoice-buttons button {
  font-weight: bold;
  color: var(--white-color);
  border: none;
  background-color: var(--title-color);
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
  padding: 11px 35px;
}
.invoice-buttons a svg,
.invoice-buttons button svg {
  margin-right: 5px;
}
.invoice-buttons .download_btn {
  background-color: var(--theme-color);
  border-radius: 0 99px 99px 0;
}
.invoice-buttons .print_btn {
  border-radius: 99px 0 0 99px;
}
@media print {
  .invoice-buttons {
    display: none !important;
  }
  .as-invoice .download-inner {
    padding: 0;
  }
  .invoice-container {
    width: 100%;
    max-width: 880px;
  }
  .invoice-container-wrap {
    overflow-x: hidden;
  }
}
.invoice_style1 {
  padding-bottom: 1px;
}
.invoice-number {
  margin-bottom: 0;
}
.invoice-date {
  margin-bottom: 0;
}
.invoice_style1 .invoice-note {
  position: relative;
  z-index: 2;
  margin-bottom: 0;
  border-top: none;
  border-bottom: none;
  padding-top: 0;
  padding-bottom: 0;
  text-align: left;
}
.invoice_style1 .invoice-note:before {
  content: "";
  height: 30px;
  width: 77px;
  background-color: var(--smoke-color);
  position: absolute;
  top: -4px;
  left: -50px;
  border-radius: 0 99px 99px 0;
  z-index: -1;
}
.invoice_style1 .invoice-note svg {
  margin-right: 24px;
}
.invoice_style1 .invoice-buttons {
  margin-bottom: 16px;
  margin-top: 30px;
}
.invoice_style2 .invoice-note {
  padding-top: 0;
  padding-bottom: 0;
  border-top: none;
  border-bottom: 1px solid var(--border-color);
  padding-bottom: 20px;
  margin-bottom: 20px;
  margin-top: 20px;
}
.invoice_style2 .invoice-table th:nth-child(2),
.invoice_style2 .invoice-table td:nth-child(2) {
  text-align: center;
}
.header-bottom_left,
.header-bottom_right {
  position: relative;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
}
.header-bottom_left p,
.header-bottom_right p {
  margin-bottom: 0;
  background-color: var(--smoke-color);
  padding: 11px 20px;
  width: 270px;
  position: relative;
  z-index: 2;
}
.header-bottom_left .shape,
.header-bottom_right .shape {
  display: inline-block;
  min-height: 44px;
  height: 100%;
  width: 10px;
  background-color: var(--smoke-dark);
  margin-left: 6px;
  -webkit-transform: skewX(33deg);
  -ms-transform: skewX(33deg);
  transform: skewX(33deg);
}
.header-bottom_left p {
  -webkit-clip-path: polygon(0 0, calc(100% - 30px) 0%, 100% 100%, 0% 100%);
  clip-path: polygon(0 0, calc(100% - 30px) 0%, 100% 100%, 0% 100%);
}
.header-bottom_left .shape:first-of-type {
  margin-left: -9px;
}
.header-bottom_right p {
  text-align: right;
  -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 30px 100%);
  clip-path: polygon(0 0, 100% 0, 100% 100%, 30px 100%);
}
.header-bottom_right .shape:last-of-type {
  margin-right: -8px;
}
.booking-info {
  margin-top: 5px;
  margin-bottom: 25px;
  position: relative;
}
.booking-info::before {
  content: "";
  height: 34px;
  width: 2px;
  position: absolute;
  left: 5px;
  top: 12px;
  background-color: var(--smoke-dark);
}
.booking-info p {
  margin-bottom: 12px;
  position: relative;
  padding-left: 20px;
}
.booking-info p:before {
  content: "";
  height: 12px;
  width: 12px;
  background-color: var(--smoke-dark);
  border-radius: 99px;
  position: absolute;
  top: 5px;
  left: 0;
}
.booking-info p:last-of-type {
  margin-bottom: 0;
}
.address-box {
  margin-bottom: 30px;
  padding: 25px 30px;
  border: 1px solid var(--border-color);
}
.address-box address {
  margin-bottom: 0;
}
.address-left {
  border-right: none;
  border-radius: 10px 0 0 10px;
}
.address-right {
  border-radius: 0 10px 10px 0;
}
.company-address {
  text-align: center;
  background-color: var(--smoke-color);
  padding: 13px 30px;
  border-radius: 999px;
  margin-top: 15px;
  margin-bottom: 26px;
}
.invoice_style3 {
  padding-bottom: 30px;
}
.invoice_style3 .big-title {
  font-size: 40px;
}
.invoice_style3 .header-bottom {
      border-bottom: 3px solid #224593;
    padding-bottom: 14px;
    margin-top: 0px;
}
.footer-info {
  background-color: var(--title-color);
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 4px;
}
.footer-info .info {
  color: #1cb9c8;
  padding: 0 40px;
}
.footer-info .info.left {
  border-right: 1px solid var(--white-color);
}
.table-stripe2 tr {
  border-bottom: none;
}
.table-stripe2 tr th:last-child,
.table-stripe2 tr td:last-child {
  text-align: left;
}
.table-stripe2 tr:nth-child(odd) th,
.table-stripe2 tr:nth-child(odd) td {
  background-color: var(--smoke-color);
}
.table-stripe2 tr:last-child td {
  padding: 18px 20px;
}
.header-layout4 {
  border-bottom: 1px solid var(--border-color);
  padding-bottom: 25px;
  margin-bottom: 25px;
}
.header-layout4 .big-title {
  font-size: 24px;
  margin-bottom: 5px;
}
.header-layout4 span {
  display: block;
  text-align: right;
}
.company-address.style2 {
  background-color: transparent;
  padding-bottom: 0;
  padding-top: 0;
}
.body-shape4,
.body-shape5 {
  display: inline-block;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 0 80px 80px 0;
  border-color: transparent var(--smoke-dark) transparent transparent;
  position: absolute;
}
.body-shape4 {
  top: 0;
  right: 0;
}
.body-shape5 {
  left: 0;
  bottom: 0;
  -webkit-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  transform: rotate(180deg);
}
.table-stripe3 {
  border: 1px solid var(--smoke-color);
}
.table-stripe3 thead tr {
  border-bottom: 1px solid var(--smoke-dark);
}
.table-stripe3 tr {
  border-bottom: 1px solid var(--smoke-color);
}
.table-stripe3 tr th,
.table-stripe3 tr td {
  border-right: 1px solid var(--border-color);
}
.table-stripe3 tr th:nth-child(2),
.table-stripe3 tr td:nth-child(2) {
  text-align: left;
}
.table-stripe3 tr th:last-child,
.table-stripe3 tr td:last-child {
  border-right: none;
}
.table-stripe3 tr:nth-child(even) th,
.table-stripe3 tr:nth-child(even) td {
  background-color: var(--smoke-color);
}
.table-stripe3 thead th,
.table-stripe3 thead td {
  background-color: var(--smoke-dark) !important;
  border-radius: 0 !important;
  border-top: 1px solid #e0e0e0;
}
.table-stripe3.style2 tr th,
.table-stripe3.style2 tr td {
  border-right: none;
  border-left: none;
}
.table-stripe3.style2 tr th:last-child,
.table-stripe3.style2 tr td:last-child {
  text-align: right;
}
.table-stripe3 tfoot tr {
  border-top: 1px solid var(--smoke-color);
  background-color: var(--smoke-color);
}
.table-stripe3 tfoot tr td,
.table-stripe3 tfoot tr th {
  text-align: right;
}
.table-stripe3 tfoot tr td:last-child,
.table-stripe3 tfoot tr th:last-child {
  border-left: none;
  text-align: right;
}
.table-stripe3 tfoot tr td:not(:last-child),
.table-stripe3 tfoot tr th:not(:last-child) {
  border-right: none;
  padding-right: 0;
}
.table-stripe3.style3 th,
.table-stripe3.style3 td {
  text-align: center !important;
}
.table-stripe3.style4 th,
.table-stripe3.style4 td {
  text-align: center !important;
}
.table-stripe3.style4 th:first-child,
.table-stripe3.style4 td:first-child {
  text-align: left !important;
}
.table-stripe3.style4 th:last-child,
.table-stripe3.style4 td:last-child {
  text-align: right !important;
}
.table-style1 {
  border: 1px solid var(--smoke-color);
  margin-top: -10px;
}
.table-style1 tr th,
.table-style1 tr td {
  text-align: left !important;
  border-radius: 0 !important;
  border-bottom: 1px solid var(--smoke-color);
  width: 32.9%;
}
.table-style1 thead th,
.table-style1 thead td {
  border-right: 1px solid var(--border-color);
}
.table-style1 thead th:last-child,
.table-style1 thead td:last-child {
  border-right: none;
}
.table-style2 b,
.table-style2 th {
  font-weight: 600;
}
.table-style2 th,
.table-style2 td {
  border-radius: 0 !important;
  border-right: 1px solid var(--smoke-color);
  padding: 4px 20px;
}
.table-style2 th:first-child,
.table-style2 td:first-child {
  border-left: 1px solid var(--smoke-color);
}
.table-style2 td {
  font-size: 12px;
}
.table-style2 td:last-child {
  text-align: left;
}
.table-style2 tr {
  border-bottom: none;
}
.table-style2 tr:last-child {
  border-bottom: 1px solid var(--smoke-color);
}
.table-style2 tr:last-child th,
.table-style2 tr:last-child td {
  padding-bottom: 15px;
}
.table-style2 tr:first-child {
  border-top: 1px solid var(--smoke-color);
}
.table-style2 tr:first-child th,
.table-style2 tr:first-child td {
  padding-top: 15px;
}
.total-table2 {
  border: none;
}
.total-table2 th,
.total-table2 td {
  border: none;
  padding: 5px 20px;
}
.total-table2 th:last-child,
.total-table2 td:last-child {
  text-align: right;
}
.body-shape6,
.body-shape7 {
  position: absolute;
  top: 0;
  left: 50%;
  -webkit-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  transform: translateX(-50%);
  display: inline-block;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 100px 100px 0 100px;
  border-color: var(--smoke-dark) transparent transparent transparent;
  margin-left: -6px;
}
.body-shape7 {
  margin-left: 6px;
  border-color: var(--smoke-color) transparent transparent transparent;
  z-index: -1;
}
.invoice_style7 .address-box {
  padding: 15px 20px;
}
.invoice_style7 .address-left {
  border-right: none;
  border-radius: 0;
}
.invoice_style7 .address-right {
  border-radius: 0;
}
.invoice_style7 .address-middle {
  border-right: none;
}
.invoice_style7 .table2 {
  margin-top: 30px;
}
.header-layout5 {
  margin-bottom: 25px;
}
.header-layout5 .big-title {
  font-size: 24px;
  margin-bottom: 6px;
}
.header-layout5 span {
  display: block;
  text-align: right;
}
.table-style3 {
  border: 1px solid var(--smoke-color);
}
.table-style3 tr {
  border-bottom: 1px solid var(--smoke-color);
}
.table-style3 tr:nth-child(odd) th,
.table-style3 tr:nth-child(odd) td {
  background-color: var(--smoke-color);
}
.table-style3 th,
.table-style3 td {
  border-right: 1px solid var(--border-color);
  width: 27%;
  padding: 11px;
}
.table-style3 th:last-child,
.table-style3 td:last-child {
  border-right: none;
  text-align: left;
}
.table-style3 th:first-child,
.table-style3 td:first-child {
  width: 19%;
}
.header-layout6 {
  margin-bottom: 30px;
}
.header-layout6 .big-title {
  font-size: 24px;
  margin-bottom: 6px;
}
.header-layout6 .header-bottom {
  margin-top: 30px;
}
.body-shape8 {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 165px;
  background-color: #e7e9ed;
  z-index: -1;
}
.table-style4 {
  border: 1px solid var(--smoke-color);
}
.table-style4 thead tr {
  border-bottom: 1px solid var(--smoke-dark);
}
.table-style4 thead th {
  border-radius: 0 !important;
}
.table-style4 tr {
  border-bottom: none;
}
.table-style4 th,
.table-style4 td {
  text-align: center;
  border-right: 1px solid var(--border-color);
  width: 21%;
}
.table-style4 th:last-child,
.table-style4 td:last-child {
  border-right: none;
  text-align: center;
}
.table-style4 th:first-child,
.table-style4 td:first-child {
  width: 37%;
}
.header-bottom .shape2 {
  height: 100%;
  width: calc(100% + 3px);
  position: absolute;
  top: 5px;
  background-color: var(--smoke-dark);
  z-index: 0;
}
.header-bottom_left .shape2 {
  -webkit-clip-path: polygon(0 0, calc(100% - 30px) 0%, 100% 100%, 0% 100%);
  clip-path: polygon(0 0, calc(100% - 30px) 0%, 100% 100%, 0% 100%);
  left: 0;
  width: calc(100% + 10px);
}
.header-bottom_right .shape2 {
  -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 30px 100%);
  clip-path: polygon(0 0, 100% 0, 100% 100%, 30px 100%);
  right: 0;
}
.invoice_style9 {
  padding-bottom: 15px;
}
.header-layout7 {
  margin-bottom: 48px;
}
.header-layout7 .big-title {
  font-size: 24px;
  margin-bottom: 6px;
}
.header-layout7 span {
  display: block;
  text-align: right;
}
.body-shape9 {
  position: absolute;
  top: 25px;
  left: 25px;
  width: calc(100% - 50px);
  height: 125px;
  background-color: var(--smoke-color);
  z-index: -1;
}
.invoice_style10 .header-layout7 {
  padding-right: 65px;
}
.info-box {
  background-color: var(--smoke-color);
  padding: 15px 20px;
  margin-bottom: 30px;
  border-right: 1px solid #e0e0e0;
}
.info-right {
  border-right: none;
}
.table-style5 {
  border: 1px solid var(--smoke-color);
}
.table-style5 thead th,
.table-style5 thead td {
  background-color: var(--smoke-dark);
}
.table-style5 thead th:first-child,
.table-style5 thead td:first-child {
  border-radius: 0;
}
.table-style5 thead th:last-child,
.table-style5 thead td:last-child {
  border-radius: 0;
}
.table-style5 th,
.table-style5 td {
  border-right: 1px solid var(--smoke-color);
}
.table-style5 th:first-child,
.table-style5 td:first-child {
  width: 55%;
}
.table-style5 th:last-child,
.table-style5 td:last-child {
  border-right: none;
}
.table-style5 tr {
  border-bottom: none;
  border-top: 1px solid var(--smoke-color);
}
.table-style5 tr:last-child {
  background-color: var(--smoke-color);
}
.table-style5 tr:last-child td {
  text-align: right;
}
.table-style5 tr:last-child td:first-child {
  padding-right: 0;
}
.body-shape10 {
  position: absolute;
  top: 0;
  right: 36px;
  background-color: var(--smoke-color);
  width: 300px;
  height: 155px;
  z-index: -1;
  -webkit-transform: skewX(-25deg);
  -ms-transform: skewX(-25deg);
  transform: skewX(-25deg);
}
.header-layout8 .big-title {
  font-size: 40px;
  text-transform: uppercase;
  margin-bottom: 0;
}
.header-layout8 .header-bottom {
  margin-top: 30px;
  margin-bottom: 30px;
}
.header-bottom {
  position: relative;
  z-index: 2;
}
.header-bottom .shape-left {
  height: 44px;
  width: 50%;
  background-color: var(--smoke-dark);
  position: absolute;
  top: -10px;
  left: -50px;
  z-index: -1;
  -webkit-clip-path: polygon(
    calc(100% - 30px) 0,
    100% 50%,
    calc(100% - 30px) 100%,
    0 100%,
    0 0
  );
  clip-path: polygon(
    calc(100% - 30px) 0,
    100% 50%,
    calc(100% - 30px) 100%,
    0 100%,
    0 0
  );
}
.header-layout10 .big-title {
  font-size: 40px;
  text-transform: uppercase;
  margin-bottom: 6px;
}
.header-layout10 span {
  display: block;
  text-align: right;
}
.border-box {
  border: 1px solid var(--border-color);
  padding: 25px 30px;
}
.table-style6 {
  border: 1px solid var(--smoke-color);
}
.table-style6 tr {
  border-top: 1px solid var(--smoke-color);
  border-bottom: none;
}
.table-style6 tr:nth-child(odd) {
  background-color: var(--smoke-color);
}
.table-style6 th,
.table-style6 td {
  border-right: 1px solid var(--border-color);
  width: 25%;
}
.table-style6 th:last-child,
.table-style6 td:last-child {
  text-align: left;
  border-right: none;
}
.table-style7 {
  border: 1px solid var(--smoke-color);
}
.table-style7 tr {
  border-bottom: none;
}
.table-style7 tr:nth-child(odd) td {
  background-color: var(--smoke-color);
}
.table-style7 td {
  border-right: 1px solid var(--border-color);
  width: 50%;
}
.table-style7 td:last-child {
  border-right: none;
  text-align: left;
}
.border-right {
  border-right: 1px solid var(--border-color);
}
.invoice_style14 {
  padding-bottom: 30px;
}
.address-bg1 {
  background-color: var(--smoke-color);
  padding: 25px 30px;
}
.invoice_style15 {
  padding-bottom: 15px;
}
.header-layout11 {
  padding-top: 20px;
  padding-bottom: 20px;
  margin-bottom: 45px;
}
.header-layout11 .big-title {
  font-size: 24px;
  text-transform: uppercase;
  margin-bottom: 6px;
}
.header-layout11 span {
  display: block;
  text-align: right;
}
.svg-shape1 {
  position: absolute;
  top: 25px;
  left: 50%;
  -webkit-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  transform: translateX(-50%);
  z-index: -1;
}
.table-style8 {
  border: 1px solid #e7e9ed;
}
.table-style8 tr {
  border-bottom: 1px solid #e7e9ed;
}
.table-style8 th,
.table-style8 td {
  border-right: 1px solid #e7e9ed;
  padding: 11px 15px;
}
.table-style8 th:last-child,
.table-style8 td:last-child {
  text-align: left;
  border-right: none;
}
.bg-white1 {
  background-color: var(--white-color);
  padding: 15px 20px;
  margin-bottom: 25px;
  box-shadow: 0px 0px 10px rgba(1, 5, 14, 0.08);
}
.bg-white1 .total-table2 {
  margin-bottom: 0;
}
.header-layout12 .big-title {
  font-size: 24px;
  text-transform: uppercase;
  margin-bottom: 6px;
}
.header-layout12 span {
  display: block;
  text-align: right;
}
.body-shape11 {
  position: absolute;
  top: 0;
  left: 0;
  background-color: #e7e9ed;
  width: 100%;
  height: 390px;
  z-index: -1;
  border-radius: 0 0 70px 70px;
}
.table-stripe3.style5 th:last-child,
.table-stripe3.style5 td:last-child {
  text-align: left;
}
.info-box2 {
  background-color: var(--smoke-color);
  border-right: 1px solid var(--border-color);
  padding: 15px 20px;
}
.info-box2.text-end {
  border-right: none;
}
.singature {
  margin-bottom: 0;
  text-align: center;
  border-top: 1px solid var(--border-color);
  padding: 8px 35px 0 35px;
}
.invoice_style19 .total-table2 {
  margin-bottom: 8px;
}
hr.style2 {
  margin-top: 8px;
  margin-bottom: 12px;
  background-color: var(--border-color);
  opacity: 1;
}
.table-style9 {
  border: 1px solid var(--smoke-color);
}
.table-style9 thead th,
.table-style9 thead td {
  background-color: var(--smoke-dark);
}
.table-style9 thead th:first-child,
.table-style9 thead td:first-child {
  border-radius: 0;
}
.table-style9 thead th:last-child,
.table-style9 thead td:last-child {
  border-radius: 0;
}
.table-style9 tr {
  border-bottom: none;
  border-top: 1px solid var(--smoke-color);
}
.table-style9 th,
.table-style9 td {
  border-right: 1px solid var(--smoke-color);
}
.table-style9 th:last-child,
.table-style9 td:last-child {
  border-right: none;
}
.table-style9 tfoot th,
.table-style9 tfoot td {
  background-color: var(--smoke-color);
  text-align: right;
}
.table-style9 tfoot th:not(:last-child),
.table-style9 tfoot td:not(:last-child) {
  padding-right: 0;
}
.header-layout13 .big-title {
  font-size: 40px;
  text-transform: uppercase;
  margin-bottom: 0;
}
hr.style3 {
  margin: 9px 0;
  background-color: var(--border-color);
  opacity: 1;
}
[dir="rtl"] .invoice-buttons {
  -webkit-box-orient: horizontal;
  -webkit-box-direction: reverse;
  -webkit-flex-direction: row-reverse;
  -ms-flex-direction: row-reverse;
  flex-direction: row-reverse;
}
[dir="rtl"] .invoice-buttons button svg {
  margin-left: 6px;
  margin-right: 0;
}
[dir="rtl"] .header-layout12 .big-title {
  text-align: left;
  font-size: 40px;
}
[dir="rtl"] .header-layout12 span {
  text-align: left;
}
[dir="rtl"] .invoice-right {
  text-align: left;
}
[dir="rtl"] .table-style9 th:last-child,
[dir="rtl"] .table-style9 td:last-child {
  border-right: 1px solid var(--smoke-color);
  text-align: left;
}
[dir="rtl"] .table-style9 tfoot th:not(:last-child),
[dir="rtl"] .table-style9 tfoot td:not(:last-child) {
  padding-left: 0;
  text-align: left;
}
[dir="rtl"] .total-table2 th:last-child,
[dir="rtl"] .total-table2 td:last-child {
  text-align: left;
}
.color_blue {
  --smoke-dark: #1cb9c8;
}
.color_blue th {
  color: var(--white-color);
}
.template_shape1 {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  text-align: center;
}
.body-shape9 img {
  height: 100%;
  width: 100%;
  object-fit: cover;
}
.as-header.style_white h1,
.as-header.style_white .h1,
.as-header.style_white p,
.as-header.style_white span,
.as-header.style_white b {
  color: var(--white-color);
}
.as-header.style_white b {
  font-weight: 600;
}
.as-header.style_white .svg-shape1 {
  left: 25px;
  width: calc(100% - 50px);
  -webkit-transform: translate(0, 0);
  -ms-transform: translate(0, 0);
  transform: translate(0, 0);
}
.as-header.style_white .svg-shape1 img {
  height: 100%;
  width: 100%;
}
.dark_mode {
  --white-color: #010f1c;
  --title-color: #fff;
  --body-color: #e7e9ed;
  --smoke-color: #1a2733;
  --smoke-dark: #1cb9c8;
  --border-color: #1a2733;
}
.dark_mode address,
.dark_mode td {
  color: var(--body-color);
}
.dark_mode .address-box {
  background-color: var(--smoke-color);
  --border-color: #323d45;
}
.dark_mode .print_btn {
  color: var(--theme-color);
}
.dark_mode .print_btn:hover {
  background-color: var(--smoke-color);
}
.dark_mode .download_btn {
  color: #fff;
}
.dark_mode .download_btn:hover {
  background-color: var(--smoke-color);
}
.invoice-table th {
    color: white;
}
</style>
</head>

<body>
    <div class="invoice-container-wrap">
        <div >
              <div class="as-invoice invoice_style3">
                 <div >
                    <header class="as-header header-layout1">
                       <div class="row align-items-center justify-content-between">
                          <div class="col-auto">
                             <div class="header-logo"><a href=""><img class="llos" width="100" src="{{asset('assets/img/logo.png')}}" alt="Invce"></a></div>
                          </div>
                          <div class="col-auto">
                             <h1 class="big-title">Invoice</h1>
                          </div>
                       </div>
                       <div class="header-bottom">
                          <div class="row align-items-center justify-content-end">
                             <div class="col-auto">
                                <p class="invoice-number me-4"><b>Invoice No: </b>#{{$order->order_number}}</p>
                             </div>
                             <div class="col-auto">
                                <p class="invoice-date"><b>Date: </b>{{date('d/M/Y',strtotime($order->created_at))}}</p>
                             </div>
                          </div>
                       </div>
                    </header>
                    <div class="row justify-content-between mb-4">
                       <div class="col-auto">
                          <div class="invoice-left">
                             <!-- <b>Invoiced To:</b> -->
                             <b>Sold by :</b>
                             <address> <strong>Name</strong> : Manish Kumar Singh<br> 
                              <strong>Address</strong> : Delhi NCR India, Pitampura <br> 
                              <strong>Pan No:</strong> GBVPS1437M<br> 
                              <strong>GST no :</strong> 07GBVPS1437M1ZQ</address>
                        
                          </div>
                       </div>
                     
                    </div>
                    <table class="invoice-table table-bordered">
                       <thead>
                          <tr>
                             <th>SL.</th>
                             <th> Product Name</th>
                             <th>Unit Price</th>
                             <th>Qty</th>
                             <th>Total Amt</th>
                          </tr>
                       </thead>
                       <tbody>
                        @php $sum=0;$total_tax=0;$total_net_amount=0;@endphp
                        @foreach ($order->items as $key=>$row)
                            <tr>
                                <td style="padding: 10px;vertical-align: top; display: flex;align-items: center;">
                                    {{-- <img src="{{ URL::asset('/assets/img/product/product1.jpg')}}" alt="img" class="me-2" style="width:40px;height:40px;"> --}}
                                    {{$row->description}}
                                </td>
                                <td style="padding: 10px;vertical-align: top; ">
                                    {{$row->quantity}}
                                </td>
                                <td style="padding: 10px;vertical-align: top; ">
                                    {{$row->amount}}
                                </td>
                                
                                <td style="padding: 10px;vertical-align: top; ">
                                    {{$row->amount*$row->quantity}}
                                </td>
                            </tr>
                        @endforeach
                          
                          


                       </tbody>
                    </table>
                    <div class="row justify-content-between">
                       
                       <div class="col-auto">
                          <table class="total-table ">
                             <tr>
                                <th class="text-dark">Tax Amount:</th>
                                <td class="text-dark">{{$order->gst_amount}}</td>
                             </tr> 
                             <tr>
                                <th class="text-dark">Discount:</th>
                                <td class="text-dark">{{$order->discount_amount}}</td>
                             </tr>
                             <tr>
                                <th class="text-dark">Total Net Amount:</th>
                                <td class="text-dark">{{$order->total_amount}}</td>
                             </tr>
                             <tr>
                                <th class="text-dark">Total Amount:</th>
                                <td class="text-dark">{{$order->payable_amount}}</td>
                             </tr>
                          </table>
                       </div>
                    </div>
                    <p class="invoice-note mt-3 text-center">
                        <i class="fa fa-file" style="color:#3ea8a2; padding-top:10px;"></i>
                      
                       <b>NOTE: </b>This is computer generated receipt and does not require physical signature.
                    </p>
                    <div class="footer-info" style="background: black;">
                       <div class="row gx-0 justify-content-center">
                          <div class="col-auto"><span class="info left">Call: +918787777907</span></div>
                          <div class="col-auto"><span class="info right">{{env('BUSINESS_EMAIL')}}</span></div>
                       </div>
                    </div> 
                 </div>
                  
              </div>
        </div>
     </div>
      

</html>
