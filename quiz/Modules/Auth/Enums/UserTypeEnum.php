<?php
namespace Modules\Auth\Enums;
enum UserTypeEnum :String{
    case Particular ="particular";
    case Professional="professional";
    case Agent="agent";
}