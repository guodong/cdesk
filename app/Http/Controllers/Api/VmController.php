<?php namespace App\Http\Controllers\Api;

use App\Models\Server;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Vm;
class VmController extends Controller {

	public function index()
	{
	    $conn = libvirt_connect('qemu+tcp://localhost/system', false);
	    $doms = libvirt_list_domains($conn);
	    $r_doms = [];
	    foreach ($doms as $dom){
	        $r_dom = new \stdClass();
	        $res =libvirt_domain_lookup_by_name($conn, $dom);
	        $dd = libvirt_domain_get_info($res);
	        $r_dom->name = $dom;
	        $r_dom->cpu = $dd['nrVirtCpu'];
	        $r_dom->memory = $dd['maxMem']/1024/1024;
	        $r_dom->state = $dd['state'];
	        $r_doms[] = $r_dom;
	    }
	    return $r_doms;
		return Vm::orderBy('created_at', 'asc')->get();
	}
	
	public function store()
	{
	    $vm = Vm::create(Input::get());
	    
	    $xml = <<<XML
<domain type='kvm'>
  <name>{$vm->id}</name>
  <memory unit='MiB'>{$vm->memory}</memory>
  <currentMemory unit='MiB'>{$vm->memory}</currentMemory>
  <vcpu placement='static'>{$vm->cpu}</vcpu>
  <resource>
    <partition>/machine</partition>
  </resource>
  <os>
    <type arch='x86_64' machine='pc-i440fx-rhel7.0.0'>hvm</type>
    <boot dev='hd'/>
  </os>
  <features>
    <acpi/>
    <apic/>
    <pae/>
  </features>
  <clock offset='utc'/>
  <on_poweroff>destroy</on_poweroff>
  <on_reboot>restart</on_reboot>
  <on_crash>restart</on_crash>
  <devices>
    <emulator>/usr/libexec/qemu-kvm</emulator>
    <disk type='file' device='disk'>
      <driver name='qemu' type='qcow2' cache='none'/>
      <source file='/var/lib/libvirt/images/{$vm->id}.qcow2'/>
      <target dev='hda' bus='ide'/>
      <alias name='ide0-0-0'/>
      <address type='drive' controller='0' bus='0' target='0' unit='0'/>
    </disk>
    <controller type='usb' index='0'>
      <alias name='usb0'/>
      <address type='pci' domain='0x0000' bus='0x00' slot='0x01' function='0x2'/>
    </controller>
    <controller type='ide' index='0'>
      <alias name='ide0'/>
      <address type='pci' domain='0x0000' bus='0x00' slot='0x01' function='0x1'/>
    </controller>
    <controller type='virtio-serial' index='0'>
      <alias name='virtio-serial0'/>
      <address type='pci' domain='0x0000' bus='0x00' slot='0x04' function='0x0'/>
    </controller>
    <interface type='bridge'>
      <source bridge='br0'/>
    </interface>
    <serial type='pty'>
      <source path='/dev/pts/2'/>
      <target port='0'/>
      <alias name='serial0'/>
    </serial>
    <console type='pty' tty='/dev/pts/2'>
      <source path='/dev/pts/2'/>
      <target type='serial' port='0'/>
      <alias name='serial0'/>
    </console>
    <channel type='spicevmc'>
      <target type='virtio' name='com.redhat.spice.0'/>
      <alias name='channel0'/>
      <address type='virtio-serial' controller='0' bus='0' port='1'/>
    </channel>
    <input type='mouse' bus='ps2'/>
    <graphics type='spice' port='{$vm->port}' autoport='no' listen='0.0.0.0'>
      <listen type='address' address='0.0.0.0'/>
    </graphics>
    <video>
      <model type='qxl' ram='65536' vram='65536' heads='1'/>
      <alias name='video0'/>
      <address type='pci' domain='0x0000' bus='0x00' slot='0x02' function='0x0'/>
    </video>
    <memballoon model='virtio'>
      <alias name='balloon0'/>
      <address type='pci' domain='0x0000' bus='0x00' slot='0x05' function='0x0'/>
    </memballoon>
  </devices>
  <seclabel type='dynamic' model='selinux' relabel='yes'>
    <label>system_u:system_r:svirt_t:s0:c786,c813</label>
    <imagelabel>system_u:object_r:svirt_image_t:s0:c786,c813</imagelabel>
  </seclabel>
</domain>
XML;
	    $conn = libvirt_connect('qemu+tcp://192.168.1.143/system', false);
	    libvirt_domain_create_xml($conn, $xml);
	}

}
