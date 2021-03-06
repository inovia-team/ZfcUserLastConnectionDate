<?php
/**
 * Created by PhpStorm.
 * User: mohamed.benaida
 * Date: 3/2/15
 * Time: 7:03 PM
 */
namespace ZfcUserLastConnectionDate\Service;
use ZfcUserLastConnectionDate\Entity\LastConnectionDateSettableInterface;
use ZfcUser\Mapper\UserInterface;


class UpdateDate {
    /**
     * @param $userId Integer
     * @param $zfcMapper
     * @return bool
     * @throws \Exception
     */
    public function updateDateFromIdUser($userId, $zfcMapper) {


        if (!$zfcMapper instanceof UserInterface) {
            throw new \RuntimeException('Invalid Mapper passed to lastConnectionDate update service');
        }
        if (!$userId ||  !is_int($userId)) {
            throw new \RuntimeException('Invalid userId passed to lastConnectionDate update service');
        }

        /**
         * @var $user \ZfcUserLastConnectionDate\Entity\LastConnectionDateUser
         */
        $user = $zfcMapper->findById($userId);

        if ($user instanceof LastConnectionDateSettableInterface) {
            $dateTime = new \DateTime('NOW');
            $lastDate = $dateTime->format(\DateTime::ISO8601);
            $user->setLastConnectionDate($lastDate);
            $zfcMapper->Update($user);
            return true;
        }
        return false;
    }
}
