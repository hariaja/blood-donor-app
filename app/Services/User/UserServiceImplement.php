<?php

namespace App\Services\User;

use App\Helpers\Global\Constant;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Helpers\Global\Helper;
use App\Models\Donor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Repositories\User\UserRepository;
use App\Repositories\BloodType\BloodTypeRepository;
use App\Repositories\Donor\DonorRepository;
use App\Repositories\Role\RoleRepository;

class UserServiceImplement extends Service implements UserService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $bloodTypeRepository;
  protected $donorRepository;
  protected $roleRepository;

  public function __construct(
    UserRepository $mainRepository,
    BloodTypeRepository $bloodTypeRepository,
    DonorRepository $donorRepository,
    RoleRepository $roleRepository,
  ) {
    $this->mainRepository = $mainRepository;
    $this->bloodTypeRepository = $bloodTypeRepository;
    $this->donorRepository = $donorRepository;
    $this->roleRepository = $roleRepository;
  }

  public function excludeAdmin()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->excludeAdmin();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function getBloodTypes()
  {
    DB::beginTransaction();
    try {
      $return = $this->bloodTypeRepository->orderByType();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function onlyDonor()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->onlyDonor();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function registerUsers(Request $request)
  {
    DB::beginTransaction();
    try {

      // Handle upload image.
      if ($request->file('avatar')) :
        $avatar = Storage::putFile('public/images/donors', $request->file('avatar'));
      else :
        $avatar = null;
      endif;

      // Get age.
      $age = Helper::convertToAge($request->birth_date);

      // Get validated request.
      $validation = $request->validated();
      $validation['age'] = $age;
      $validation['avatar'] = $avatar;
      $validation['password'] = $request->roles ? Hash::make(Constant::PASSWORD) : Hash::make($request->password);
      $validation['status'] = Constant::ACTIVE;

      // Create user & sync user.
      $user = $this->mainRepository->create($validation);
      $user->assignRole(Constant::DONOR);

      $data = array();
      $data['nik'] = $request->nik;
      $data['user_id'] = $user->id;
      $data['blood_type_id'] = $validation['blood_type_id'];
      $data['rhesus'] = $request['rhesus'];
      $data['gender'] = $validation['gender'];
      $data['birth_date'] = $validation['birth_date'];
      $data['age'] = $validation['age'];
      $data['job_title'] = $validation['job_title'];
      $data['address'] = $validation['address'];

      // Create donor user.
      $this->donorRepository->create($data);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }

    DB::commit();
    return $user;
  }

  public function handleCreateNewUser(Request $request)
  {
    DB::beginTransaction();
    try {

      // Handle upload image.
      if ($request->file('avatar')) :
        $avatar = Storage::putFile('public/images/officers', $request->file('avatar'));
      else :
        $avatar = null;
      endif;

      // Get validated request.
      $validation = $request->validated();
      $validation['avatar'] = $avatar;
      $validation['password'] = Hash::make(Constant::PASSWORD);
      $validation['status'] = Constant::ACTIVE;

      // Create user & sync user.
      $user = $this->mainRepository->create($validation);
      $user->assignRole($request->roles);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $user;
  }

  public function updateOfficer(User $user, Request $request)
  {
    DB::beginTransaction();
    try {

      // Handle upload image.
      if ($request->file('avatar')) :
        if ($request->old_avatar) :
          Storage::delete($user->avatar);
        endif;
        $avatar = Storage::putFile('public/images/officers', $request->file('avatar'));
      else :
        $avatar = $request->old_avatar;
      endif;

      // Get validated request.
      $validation = $request->validated();
      $validation['avatar'] = $avatar;

      // Create user & sync user.
      $user = $this->mainRepository->update($user->id, $validation);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $user;
  }

  public function updateDonor(Donor $donor, Request $request)
  {
    DB::beginTransaction();
    try {

      // Handle upload image.
      if ($request->file('avatar')) :
        if ($request->old_avatar) :
          Storage::delete($donor->user->avatar);
        endif;
        $avatar = Storage::putFile('public/images/donors', $request->file('avatar'));
      else :
        $avatar = $request->old_avatar;
      endif;

      // Get age.
      $age = Helper::convertToAge($request->birth_date);

      // Get validated request.
      $validation = $request->validated();
      $validation['avatar'] = $avatar;

      // Update user
      $user = $this->mainRepository->findOrFail($donor->user_id);
      $user->update($validation);

      // Jika pengguna memilih golongan darah tidak tahu
      if ($validation['blood_type_id'] == 1) {
        $request['rhesus'] = Constant::UNKNOWN;
      } else {
        $request['rhesus'] = $request['rhesus'];
      }

      $data = array();
      $data['age'] = $age;
      $data['nik'] = $request['nik'];
      $data['blood_type_id'] = $request['blood_type_id'];
      $data['gender'] = $request['gender'];
      $data['rhesus'] = $request['rhesus'];
      $data['birth_date'] = $request['birth_date'];
      $data['job_title'] = $request['job_title'];
      $data['address'] = $request['address'];

      // Create user & sync user.
      $donor = $this->donorRepository->update($donor->id, $data);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $user;
  }

  public function handleDeleteUserWithAvatar(User $user)
  {
    DB::beginTransaction();
    try {

      // Handle delete image.
      if ($user->avatar) :
        Storage::delete($user->avatar);
      endif;

      // Delete user.
      $user = $this->mainRepository->delete($user->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $user;
  }

  public function handleChangeStatus(int $userId)
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->changeStatus($userId);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
