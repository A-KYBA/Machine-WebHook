import type { Machine } from '../../../types/machine';
import MachineCard from '../../molecules/MachineCard/MachineCard';
import styles from './MachineGrid.module.css';

interface MachineGridProps {
  machines: Machine[];
}

function MachineGrid({ machines }: MachineGridProps) {
  return (
    <div className={styles.grid}>
      {machines.map((machine) => (
        <MachineCard key={machine.name} {...machine} />
      ))}
    </div>
  );
}

export default MachineGrid;
