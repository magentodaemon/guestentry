<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ActionVoter extends Voter
{
    const ADD = 'add';
    const VIEW = 'view';
    const LIST = 'list';
    const EDIT = 'edit';
    const DELETE = 'delete';
    const APPROVE = 'approve';

    // @codeCoverageIgnoreStart
    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::LIST, self::ADD, self::VIEW, self::EDIT, self::DELETE, self::APPROVE])) {
            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject instanceof SessionInterface) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $userType = $subject->get('userType');

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($userType);
            case self::LIST:
                return $this->canList($userType);
            case self::ADD:
                return $this->canAdd($userType);
            case self::EDIT:
                return $this->canEdit($userType);
            case self::DELETE:
                return $this->canDelete($userType);
            case self::APPROVE:
                return $this->canApprove($userType);
        }

        throw new \LogicException('This code should not be reached!');
    }
    // @codeCoverageIgnore
    
    public function canList(string $userType): bool
    {
        return true;
    }

    public function canAdd(string $userType): bool
    {
        return true;
    }

    public function canView(string $userType): bool
    {
        return true;
    }

    public function canEdit(string $userType): bool
    {
        if($userType == 'admin')
            return true;
        
        return false;
    }

    public function canDelete(string $userType): bool
    {
        if($userType == 'admin')
            return true;
        
        return false;
    }

    public function canApprove(string $userType): bool
    {
        if($userType == 'admin')
            return true;
        
        return false;
    }

}