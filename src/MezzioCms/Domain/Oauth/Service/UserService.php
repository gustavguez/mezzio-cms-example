<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Oauth\Service;

use Gustavguez\MezzioCms\Domain\Api\Common\BaseService;
use Gustavguez\MezzioCms\Domain\Oauth\Entity\UserEntity;
use Mezzio\Authentication\DefaultUser;

class UserService extends BaseService
{
	protected $class = UserEntity::class;

    public function getCurrentLoggedUser(DefaultUser $defaultUser) {
        //Check session
        if($defaultUser instanceof DefaultUser){
            //Find me
            return $this->findEntity([
                'username' => $defaultUser->getDetail('oauth_user_id')
            ]);
        }
    }
    
}
