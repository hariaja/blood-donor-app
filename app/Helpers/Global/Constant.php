<?php

namespace App\Helpers\Global;

class Constant
{
  // Role Name
  public const ADMIN = 'Administrator';
  public const OFFICER = 'Petugas';
  public const DONOR = 'Pendonor';

  public const PASSWORD = 'password';

  // Gender Name
  public const MALE = 'Laki - Laki';
  public const FEMALE = 'Perempuan';

  public const YES = 'Ya';
  public const NO = 'Tidak';

  // User Status
  public const ACTIVE = 1;
  public const INACTIVE = 0;

  // Blood Type
  public const A = 'A';
  public const B = 'B';
  public const AB = 'AB';
  public const O = 'O';
  public const UNKNOWN = 'Tidak Tahu';

  // Rhesus
  public const POSITIF = 'Positif (+)';
  public const NEGATIF = 'Negatif (-)';

  // State
  public const ALL = 'Semua Status';
  public const PENDING = 'Pending';
  public const APPROVED = 'Approved';
  public const REJECTED = 'Rejected';

  // Const
  public const LOCATION = 'Palang Merah Indonesia Kota Sukabumi';
  public const LOGO = 'assets/images/blood.png';
  public const COMPANY_PHONE = '(0266) 226551';
  public const ADDRESS = 'Jl. Arif Rahman Hakim No. 51 Benteng, Kec. Warudoyong, Kota Sukabumi, Jawa Barat 43132';

  public const HAVE_ARRIVED = 'Sudah Datang';
  public const NOT_YET_COME = 'Belum Datang';
}
