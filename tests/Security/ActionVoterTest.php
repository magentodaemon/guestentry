<?php

use PHPUnit\Framework\TestCase;
use App\Security\ActionVoter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class ActionVoterTest extends TestCase{

    public function testShouldbeAnInstanceofVoter(){
        $voter = new ActionVoter();
        $this->assertInstanceOf(VoterInterface::class, $voter);
    }

    public function testShouldAllowFollowingOperation(){
        
        $voter = new ActionVoter();
        $userType = 'any';

        $this->assertSame(true, $voter->canList($userType));
        $this->assertSame(true, $voter->canAdd($userType));
        $this->assertSame(true, $voter->canView($userType));
    }


    public function testShouldAllowFollowingOperationToAdminOnly(){
        
        $voter = new ActionVoter();
        $userType = 'admin';

        $this->assertSame(true, $voter->canEdit($userType));
        $this->assertSame(true, $voter->canDelete($userType));
        $this->assertSame(true, $voter->canApprove($userType));

        $userType = 'any';

        $this->assertSame(false, $voter->canEdit($userType));
        $this->assertSame(false, $voter->canDelete($userType));
        $this->assertSame(false, $voter->canApprove($userType));
    }

    


}